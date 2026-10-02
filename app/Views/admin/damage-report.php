<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Pelaporan Kerusakan Sarana dan Prasarana</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eaf6ff; color: #333; }
        .box { max-width: 650px; margin: 35px auto; background: #fff; padding: 30px; border-radius: 18px; }
        label { display: block; font-weight: bold; margin: 18px 0 6px; }
        .hint { font-size: 13px; color: #64748b; margin-top: -2px; margin-bottom: 8px; }
        select, textarea, input[type="file"] { 
            width: 100%; box-sizing: border-box; padding: 12px; border: 1px solid #ccc; border-radius: 9px; 
        }
        .radio-group { display: flex; flex-direction: column; gap: 10px; margin-top: 6px; }
        .radio-item { display: flex; align-items: center; gap: 10px; font-weight: normal; margin: 0; cursor: pointer; }
        .radio-item input[type="radio"] { width: auto; margin: 0; }
        button { width: 100%; padding: 13px; background: #075985; color: #fff; border: 0; border-radius: 9px; margin-top: 24px; cursor: pointer; font-weight: bold; }
        button:hover { background: #0369a1; }
        a { text-decoration: none; color: #075985; font-weight: bold; }
    </style>
</head>
<body>
    <div class="box">
        <h2>PELAPORAN KERUSAKAN SARANA DAN PRASARANA</h2>
        <a href="<?= site_url('admin/dashboard-admin') ?>">← Dashboard</a>
        
        <!-- WAJIB menambahkan enctype="multipart/form-data" -->
<form action="<?= site_url('admin/damage-report/save') ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="full_name" class="form-label">Nama Lengkap</label>
        <input type="text" name="full_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="nip" class="form-label">NIP</label>
        <input type="text" name="nip" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="department" class="form-label">Departemen / Unit</label>
        <input type="text" name="department" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">No. Telepon / WA</label>
        <input type="text" name="phone" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="damage_description" class="form-label">Deskripsi Kerusakan</label>
        <textarea name="damage_description" class="form-control" rows="3" required></textarea>
    </div>

    <!-- Input File Foto -->
    <div class="mb-3">
        <label for="photo" class="form-label">Foto Kerusakan</label>
        <input type="file" name="photo" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary">Kirim Laporan</button>
</form>
    </div>
</body>
</html>