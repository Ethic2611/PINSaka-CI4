<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Riwayat & Pengajuan</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4faff; margin: 0; padding: 0; }
        .wrap { max-width: 1100px; margin: 30px auto; padding: 20px; }
        .header-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        h1 { color: #075985; margin: 0; }
        .section-title { color: #075985; font-size: 20px; margin: 35px 0 15px; border-bottom: 2px solid #cbd5e1; padding-bottom: 8px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-bottom: 20px; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd; font-size: 14px; }
        th { background: #075985; color: white; }
        .btn { padding: 6px 12px; color: white; background: #15803d; text-decoration: none; border-radius: 6px; font-size: 13px; display: inline-block; font-weight: bold; }
        .btn.no { background: #dc2626; }
        .btn-back { text-decoration: none; color: #075985; font-weight: bold; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .badge-pending { background: #fef08a; color: #854d0e; }
        .badge-approved { background: #bbf7d0; color: #166534; }
        .badge-rejected { background: #fecaca; color: #991b1b; }
        .img-thumb { width: 50px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #ccc; }
        .alert-success { background: #dcfce7; color: #166534; padding: 12px; border-radius: 6px; margin-bottom: 16px; }
        .alert-error { background: #fee2e2; color: #991b1b; padding: 12px; border-radius: 6px; margin-bottom: 16px; }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="header-bar">
            <h1>Riwayat & Persetujuan Pengajuan</h1>
            <a class="btn-back" href="<?= site_url('admin/dashboard-admin') ?>">← Dashboard</a>
        </div>

        <!-- Flash Message -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert-error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <!-- TABEL 1: PEMINJAMAN (RUANGAN & KENDARAAN) -->
        <h2 class="section-title">Peminjaman Ruangan & Kendaraan</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pemohon</th>
                    <th>Jenis Pengajuan</th>
                    <th>Sarana / Lokasi</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($bookings) && is_array($bookings)): ?>
                    <?php $no = 1; foreach($bookings as $b): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($b['user']) ?></td>
                        <td><?= esc($b['type']) ?></td>
                        <td><?= esc($b['item']) ?></td>
                        <td><?= esc($b['date']) ?></td>
                        <td>
                            <?php 
                                $status = strtolower($b['status']);
                                $badgeClass = 'badge-pending';
                                if ($status == 'approved' || $status == 'disetujui' || $status == 'diterima') $badgeClass = 'badge-approved';
                                elseif ($status == 'rejected' || $status == 'ditolak') $badgeClass = 'badge-rejected';
                            ?>
                            <span class="badge <?= $badgeClass ?>"><?= esc(ucfirst($b['status'])) ?></span>
                        </td>
                        <td>
                            <?php if (strtolower($b['status']) == 'pending'): ?>
                                <a class="btn" href="<?= site_url('admin/approve/' . $b['source'] . '/' . $b['id']) ?>">Setujui</a>
                                <a class="btn no" href="<?= site_url('admin/reject/' . $b['source'] . '/' . $b['id']) ?>">Tolak</a>
                            <?php else: ?>
                                <span style="color: #64748b; font-size: 13px;">Selesai</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 20px; color: #64748b;">Belum ada data peminjaman.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- TABEL 2: PELAPORAN KERUSAKAN -->
        <h2 class="section-title">Pengajuan Laporan Kerusakan</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelapor</th>
                    <th>NIP / Dept</th>
                    <th>Deskripsi Kerusakan</th>
                    <th>Foto</th>
                    <th>Tanggal Lapor</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($damage_reports) && is_array($damage_reports)): ?>
                    <?php $no = 1; foreach($damage_reports as $dr): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <strong><?= esc($dr['full_name']) ?></strong><br>
                            <small style="color: #64748b;"><?= esc($dr['phone']) ?></small>
                        </td>
                        <td><?= esc($dr['nip']) ?> / <?= esc($dr['department']) ?></td>
                        <td><?= esc($dr['damage_description']) ?></td>
                        <td>
                            <?php if (!empty($dr['photo'])): ?>
                                <a href="<?= base_url('uploads/damage_reports/' . $dr['photo']) ?>" target="_blank">
                                    <img src="<?= base_url('uploads/damage_reports/' . $dr['photo']) ?>" class="img-thumb" alt="Foto">
                                </a>
                            <?php else: ?>
                                <span style="color: #94a3b8; font-size: 12px;">Tanpa Foto</span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('d-m-Y H:i', strtotime($dr['created_at'] ?? 'now')) ?></td>
                        <td>
                            <?php 
                                $status = strtolower($dr['status']);
                                $badgeClass = 'badge-pending';
                                if ($status == 'approved' || $status == 'disetujui' || $status == 'diterima') $badgeClass = 'badge-approved';
                                elseif ($status == 'rejected' || $status == 'ditolak') $badgeClass = 'badge-rejected';
                            ?>
                            <span class="badge <?= $badgeClass ?>"><?= esc(ucfirst($dr['status'])) ?></span>
                        </td>
                        <td>
                            <?php if (strtolower($dr['status']) == 'pending'): ?>
                                <a class="btn" href="<?= site_url('admin/approve/damage/' . $dr['id']) ?>" onclick="return confirm('Setujui/Terima laporan kerusakan ini?')">Setujui</a>
                                <a class="btn no" href="<?= site_url('admin/reject/damage/' . $dr['id']) ?>" onclick="return confirm('Tolak laporan kerusakan ini?')">Tolak</a>
                            <?php else: ?>
                                <span style="color: #64748b; font-size: 13px;">Selesai</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 20px; color: #64748b;">Belum ada pengajuan laporan kerusakan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>