<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Peminjaman - PINSAKA</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4faff; margin: 0; padding: 20px; }
        .wrap { max-width: 1200px; margin: 20px auto; padding: 25px; background: #fff; border-radius: 14px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        h1 { color: #075985; margin: 0; font-size: 24px; }
        .btn-group { display: flex; gap: 10px; }
        .btn { background: #075985; color: #fff; padding: 9px 16px; text-decoration: none; border-radius: 7px; font-weight: bold; font-size: 14px; transition: background 0.2s; }
        .btn:hover { background: #0369a1; }
        .btn-pdf { background: #dc2626; }
        .btn-pdf:hover { background: #b91c1c; }
        
        .alert-success { background: #d1fae5; color: #065f46; padding: 12px 16px; border-radius: 7px; margin-bottom: 20px; font-weight: bold; }
        
        .table-responsive { overflow-x: auto; margin-top: 10px; }
        table { width: 100%; border-collapse: collapse; background: #fff; font-size: 13px; }
        th, td { padding: 11px; border: 1px solid #cbd5e1; text-align: left; }
        th { background: #075985; color: white; font-weight: 600; white-space: nowrap; }
        tr:nth-child(even) { background-color: #f8fafc; }
        
        .badge { padding: 5px 10px; border-radius: 12px; font-weight: bold; font-size: 11px; display: inline-block; text-align: center; }
        .badge-pending { background: #fef3c7; color: #d97706; }
        .badge-approved { background: #d1fae5; color: #059669; }
        .badge-rejected { background: #fee2e2; color: #dc2626; }
    </style>
</head>
<body>

<div class="wrap">
    <div class="header">
        <h1>Riwayat Peminjaman Ruangan</h1>
        <div class="btn-group">
            <a class="btn" href="<?= site_url('dashboard') ?>">← Dashboard</a> 
        </div>
    </div>

    <?php if ($m = session()->getFlashdata('success')): ?>
        <div class="alert-success"><?= esc($m) ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pemohon</th>
                    <th>Kontak</th>
                    <th>Jenis</th>
                    <th>Ruangan (Sarana)</th>
                    <th>Keperluan</th>
                    <th>Peserta</th>
                    <th>Tanggal</th>
                    <th>Waktu (Jam)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($bookings)): ?>
                    <tr>
                        <td colspan="10" style="text-align: center; color: #64748b; padding: 25px; font-size: 14px;">
                            Belum ada pengajuan peminjaman yang tersimpan.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($bookings as $b): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <strong><?= esc($b['full_name'] ?? '-') ?></strong><br>
                                <small style="color: #64748b;">NIP: <?= esc($b['nip'] ?? '-') ?></small><br>
                                <small style="color: #075985;"><?= esc($b['department'] ?? '-') ?></small>
                            </td>
                            <td>
                                <?= esc($b['phone'] ?? '-') ?><br>
                                <small style="color: #64748b;"><?= esc($b['email'] ?? '-') ?></small>
                            </td>
                            <td><?= esc($b['type'] ?? 'Ruangan') ?></td>
                            <td><strong><?= esc($b['item'] ?? '-') ?></strong></td>
                            <td><?= esc($b['purpose'] ?? '-') ?></td>
                            <td><?= esc($b['personnel_count'] ?? '0') ?> Orang</td>
                            <td>
                                <?php if (!empty($b['start_date'])): ?>
                                    <?= date('d/m/Y', strtotime($b['start_date'])) ?>
                                    <?php if (!empty($b['end_date']) && $b['end_date'] !== $b['start_date']): ?>
                                        <br>s/d <?= date('d/m/Y', strtotime($b['end_date'])) ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?= esc($b['date'] ?? '-') ?>
                                <?php endif; ?>
                            </td>
                            <td><strong><?= esc($b['time_slot'] ?? ($b['start'] ?? '') . ' - ' . ($b['end'] ?? '')) ?></strong></td>
                            <td>
                                <?php 
                                    $status = $b['status'] ?? 'Pending';
                                    $badgeClass = 'badge-pending';
                                    if ($status === 'Approved') $badgeClass = 'badge-approved';
                                    elseif ($status === 'Rejected') $badgeClass = 'badge-rejected';
                                ?>
                                <span class="badge <?= $badgeClass ?>"><?= esc($status) ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>