<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Peminjaman Kendaraan</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eaf6ff; margin: 0; padding: 20px; }
        .box { max-width: 950px; margin: 30px auto; background: #fff; padding: 30px; border-radius: 18px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        h1 { color: #075985; font-size: 22px; margin-bottom: 5px; }
        .sub-header { color: #0369a1; font-weight: bold; margin-bottom: 20px; text-transform: uppercase; border-bottom: 2px solid #38bdf8; padding-bottom: 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 14px; }
        th, td { padding: 12px 14px; border-bottom: 1px solid #e2e8f0; text-align: left; }
        th { background-color: #075985; color: #fff; }
        .badge { background-color: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 20px; font-weight: bold; font-size: 12px; }
        .back-link { text-decoration: none; color: #075985; font-weight: bold; display: inline-block; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="box">
        <a href="<?= site_url('admin/vehicle-booking') ?>" class="back-link">← Kembali</a>
        
        <!-- KETERANGAN DI ATAS FORM/TABEL -->
        <h1>Riwayat Pengajuan Peminjaman Kendaraan yang Disetujui</h1>
        <div class="sub-header">Tabel Pengajuan Pinjaman Kendaraan yang Disetujui</div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemohon</th>
                    <th>Kendaraan</th>
                    <th>Keperluan</th>
                    <th>Tanggal Pinjam</th>
                    <th>Waktu</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($approved_vehicle_bookings)): ?>
                    <?php $no = 1; foreach ($approved_vehicle_bookings as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><strong><?= esc($row['full_name']) ?></strong></td>
                            <td><?= esc($row['vehicle_name']) ?></td>
                            <td><?= esc($row['purpose']) ?></td>
                            <td><?= date('d/m/Y', strtotime($row['start_date'])) ?> s/d <?= date('d/m/Y', strtotime($row['end_date'])) ?></td>
                            <td><?= esc($row['time_slots'] ?? '-') ?></td>
                            <td><span class="badge"><?= esc($row['approval_status']) ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center; color:#64748b;">Belum ada data pengajuan kendaraan yang disetujui.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>