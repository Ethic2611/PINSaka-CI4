<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Pengajuan Disetujui</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eaf6ff; color: #333; margin: 0; padding: 20px; }
        .box { max-width: 1000px; margin: 35px auto; background: #fff; padding: 30px; border-radius: 18px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        h1 { margin-top: 0; color: #075985; font-size: 24px; }
        .section-title { color: #075985; font-size: 18px; margin: 35px 0 15px; border-bottom: 2px solid #cbd5e1; padding-bottom: 8px; }
        a.back-link { text-decoration: none; color: #075985; font-weight: bold; display: inline-block; margin-bottom: 20px; }
        
        /* Table Styling */
        .table-responsive { overflow-x: auto; margin-top: 15px; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 14px; margin-bottom: 20px; }
        th, td { padding: 12px 14px; border-bottom: 1px solid #e2e8f0; vertical-align: middle; }
        th { background-color: #075985; color: #fff; font-weight: bold; }
        tr:hover { background-color: #f8fafc; }
        
        /* Badge Status */
        .badge-success { 
            background-color: #dcfce7; 
            color: #15803d; 
            padding: 4px 10px; 
            border-radius: 20px; 
            font-size: 12px; 
            font-weight: bold; 
            display: inline-block;
        }
        
        .empty-state { text-align: center; color: #64748b; padding: 20px 0; font-style: italic; }
    </style>
</head>
<body>
    <div class="box">
        <a href="<?= site_url('admin/dashboard-admin') ?>" class="back-link">← Dashboard</a>
        <h1>Riwayat Pengajuan & Laporan Disetujui</h1>
        
        <!-- TABEL 1: PEMINJAMAN RUANGAN DISETUJUI -->
        <h2 class="section-title">Peminjaman Ruangan (Disetujui)</h2>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Nama Pemohon</th>
                        <th width="20%">Ruangan</th>
                        <th width="22%">Keperluan</th>
                        <th width="18%">Tanggal Pinjam</th>
                        <th width="15%">Waktu</th>
                        <th width="10%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($approved_bookings) && is_array($approved_bookings)): ?>
                        <?php $no = 1; foreach ($approved_bookings as $booking): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <strong><?= esc($booking['full_name'] ?? $booking['name'] ?? 'Tidak Diisi') ?></strong>
                                </td>
                                <td>
                                    <strong><?= esc($booking['room_name'] ?? $booking['item'] ?? '-') ?></strong>
                                </td>
                                <td>
                                    <?= esc($booking['purpose'] ?? '-') ?>
                                </td>
                                <td>
                                    <?= date('d/m/Y', strtotime($booking['start_date'] ?? 'now')) ?> 
                                    <?= (!empty($booking['end_date']) && $booking['start_date'] != $booking['end_date']) ? ' s/d ' . date('d/m/Y', strtotime($booking['end_date'])) : '' ?>
                                </td>
                                <td>
                                    <?= esc($booking['start_time'] ?? $booking['time_slots'] ?? '-') ?>
                                    <?= !empty($booking['end_time']) ? ' - ' . esc($booking['end_time']) : '' ?>
                                </td>
                                <td>
                                    <span class="badge-success"><?= esc($booking['approval_status'] ?? 'Disetujui') ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="empty-state">Belum ada data peminjaman yang disetujui.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- TABEL 2: LAPORAN KERUSAKAN DISETUJUI (TERHUBUNG KE AcceptedDamageReportMA) -->
        <h2 class="section-title">Laporan Kerusakan (Disetujui)</h2>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Nama Pelapor</th>
                        <th width="40%">Deskripsi Kerusakan</th>
                        <th width="15%">Tanggal Diterima</th>
                        <th width="15%">Status Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($accepted_damage_reports) && is_array($accepted_damage_reports)): ?>
                        <?php $no = 1; foreach ($accepted_damage_reports as $damage): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <strong><?= esc($damage['full_name']) ?></strong>
                                </td>
                                <td><?= esc($damage['damage_description']) ?></td>
                                <td>
                                    <?= !empty($damage['accepted_at']) ? date('d/m/Y H:i', strtotime($damage['accepted_at'])) : '-' ?>
                                </td>
                                <td>
                                    <span class="badge-success"><?= esc($damage['action_status'] ?? 'Disetujui') ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="empty-state">Belum ada data laporan kerusakan yang disetujui.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
<script>
    // Fungsi untuk mengambil data terbaru dari server
    function fetchLatestBookings() {
        fetch('<?= base_url('admin/roomhistory/getLatestData') ?>')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('booking-table-body');
                
                if (data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="6" class="text-center">Belum ada data pengajuan.</td></tr>';
                    return;
                }

                let htmlContent = '';
                data.forEach(item => {
                    htmlContent += `
                        <tr>
                            <td>${item.full_name}</td>
                            <td>${item.room_name}</td>
                            <td>${item.purpose}</td>
                            <td>${item.start_date}</td>
                            <td>${item.start_time}</td>
                            <td><span class="badge">${item.approval_status}</span></td>
                        </tr>
                    `;
                });

                // Perbarui isi tabel secara otomatis di layar
                tbody.innerHTML = htmlContent;
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    // Jalankan pengecekan otomatis setiap 5 detik (5000 ms)
    setInterval(fetchLatestBookings, 5000);
</script>
</html>