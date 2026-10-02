<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Pelaporan Kerusakan - PINSAKA</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
        body { background-color: #f8fafc; color: #1e293b; line-height: 1.6; }
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 16px 40px; background: #ffffff; border-bottom: 1px solid #e2e8f0; }
        .logo { font-size: 20px; font-weight: 800; color: #075985; text-decoration: none; }
        .btn-back { background: #cbd5e1; color: #0f172a; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: bold; }
        .container { max-width: 600px; margin: 40px auto; padding: 0 20px; }
        .card { background: #ffffff; padding: 32px; border-radius: 12px; border: 1px solid #e2e8f0; }
        .card-title { font-size: 22px; font-weight: bold; color: #0f172a; margin-bottom: 20px; border-bottom: 2px solid #075985; padding-bottom: 8px; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 14px; font-weight: bold; margin-bottom: 6px; color: #334155; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; }
        .btn-submit { width: 100%; background: #075985; color: #ffffff; padding: 12px; border: none; border-radius: 6px; font-size: 15px; font-weight: bold; cursor: pointer; margin-top: 10px; }
        .btn-submit:hover { background: #0369a1; }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="<?= site_url('user/dashboard') ?>" class="logo">PINSAKA</a>
        <a href="<?= site_url('user/dashboard') ?>" class="btn-back">← Kembali ke Dashboard</a>
    </nav>

    <div class="container">
        <div class="card">
            <h2 class="card-title">🛠️ Form Pelaporan Kerusakan</h2>
            <form action="<?= site_url('user/lapor-kerusakan/store') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="form-group">
                    <label>Fasilitas / Nama Item Kerusakan</label>
                    <input type="text" name="nama_fasilitas" class="form-control" placeholder="Contoh: AC Ruang Rapat / Proyektor" required>
                </div>

                <div class="form-group">
                    <label>Lokasi Fasilitas</label>
                    <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Lantai 2 Gedung Utama" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi Detail Kerusakan</label>
                    <textarea name="deskripsi" class="form-control" rows="4" placeholder="Jelaskan kondisi atau kronologi kerusakan..." required></textarea>
                </div>

                <div class="form-group">
                    <label>Lampiran / Foto Kerusakan (Opsional)</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>

                <button type="submit" class="btn-submit">Kirim Laporan Kerusakan</button>
            </form>
        </div>
    </div>

</body>
</html>