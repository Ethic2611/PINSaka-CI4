<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Peminjaman Kendaraan Dinas - PINSAKA</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eaf6ff; margin: 0; padding: 20px 0; }
        .box { max-width: 650px; margin: 35px auto; background: #fff; padding: 30px; border-radius: 18px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
        h1 { color: #075985; margin-top: 0; }
        label { display: block; font-weight: bold; margin: 16px 0 6px; color: #1e293b; }
        .hint { font-size: 13px; color: #64748b; margin-top: -4px; margin-bottom: 8px; font-weight: normal; }
        
        input[type="text"], input[type="tel"], input[type="email"], input[type="number"], input[type="date"], select, textarea { 
            width: 100%; box-sizing: border-box; padding: 12px; border: 1px solid #cbd5e1; border-radius: 9px; font-size: 14px;
        }
        textarea { resize: vertical; height: 90px; }
        
        .row { display: flex; gap: 15px; }
        .col { flex: 1; }

        .checkbox-group { display: flex; flex-direction: column; gap: 8px; margin-top: 6px; }
        .checkbox-item { display: flex; align-items: center; gap: 8px; font-weight: normal; margin: 0; cursor: pointer; }
        .checkbox-item input { width: auto; }

        button { width: 100%; padding: 13px; background: #075985; color: #fff; border: 0; border-radius: 9px; margin-top: 24px; cursor: pointer; font-weight: bold; font-size: 16px; }
        button:hover { background: #0369a1; }
        a.back-link { display: inline-block; margin-bottom: 15px; text-decoration: none; color: #075985; font-weight: bold; }
    </style>
</head>
<body>
    <div class="box">
        <a href="<?= site_url('admin/dashboard-admin') ?>" class="back-link">← Kembali ke Dashboard</a>
        <h1>Peminjaman Kendaraan Dinas</h1>
        
        <form method="post" action="<?= site_url('admin/booking/save2') ?>">
            <?= csrf_field() ?>
            <input type="hidden" name="type" value="Kendaraan">
            
            <!-- 1. Data Pemohon -->
            <label>1. NAMA LENGKAP *</label>
            <input type="text" name="full_name" required placeholder="Masukkan nama lengkap">

            <div class="row">
                <div class="col">
                    <label>2. NIP *</label>
                    <input type="text" name="nip" required placeholder="Masukkan NIP">
                </div>
                <div class="col">
                    <label>3. BAGIAN *</label>
                    <select name="department" required>
                        <option value="">-- Pilih Bagian --</option>
                        <option value="Sabo">Sabo</option>
                        <option value="Tata Usaha">Tata Usaha</option>
                        <option value="Program & Perencanaan">Program & Perencanaan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>4. NO. HP *</label>
                    <input type="tel" name="phone" required placeholder="Contoh: 081234567890">
                </div>
                <div class="col">
                    <label>5. EMAIL *</label>
                    <input type="email" name="email" required placeholder="nama@email.com">
                </div>
            </div>

            <!-- 2. Pilih Kendaraan -->
            <label>6. PILIH KENDARAAN *</label>
            <select name="item" required>
                <option value="">-- Pilih Kendaraan --</option>
                <?php if (!empty($vehicles) && is_array($vehicles)): ?>
                    <?php foreach($vehicles as $v): ?>
                        <option value="<?= esc(is_array($v) ? ($v['name'] ?? $v['vehicle_name']) : $v) ?>">
                            <?= esc(is_array($v) ? ($v['name'] ?? $v['vehicle_name']) : $v) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Opsi fallback jika data $vehicles belum terkirim dari controller -->
                    <option value="Avanza - AB 1234 XX">Avanza - AB 1234 XX</option>
                    <option value="Innova - AB 5678 YY">Innova - AB 5678 YY</option>
                    <option value="HiAce - AB 9012 ZZ">HiAce - AB 9012 ZZ</option>
                <?php endif; ?>
            </select>

            <!-- 3. Keperluan Peminjaman -->
            <label>7. KEPERLUAN PEMINJAMAN KENDARAAN *</label>
            <div class="hint">Diisi keperluan pinjam kendaraan dan tujuan perjalanan</div>
            <textarea name="purpose" placeholder="Masukkan detail keperluan dan tujuan" required></textarea>
            
            <!-- 4. Jumlah Personil -->
            <label>8. JUMLAH PERSONIL *</label>
            <input type="number" name="personnel_count" min="1" placeholder="Masukkan jumlah penumpang" required>

            <!-- 5. Tanggal Pinjam -->
            <div class="row">
                <div class="col">
                    <label>9. TANGGAL MULAI *</label>
                    <input type="date" name="start_date" required>
                </div>
                <div class="col">
                    <label>10. TANGGAL SELESAI *</label>
                    <input type="date" name="end_date" required>
                </div>
            </div>
            
            <!-- 6. Waktu Peminjaman -->
            <label>11. WAKTU PEMINJAMAN *</label>
            <div class="hint">Dapat dipilih lebih dari satu opsi waktu sesuai durasi kebutuhan peminjaman kendaraan</div>
            <div class="checkbox-group">
                <label class="checkbox-item">
                    <input type="checkbox" name="time_slots[]" value="07.30 - 12.00 WIB">
                    07.30 - 12.00 WIB
                </label>
                <label class="checkbox-item">
                    <input type="checkbox" name="time_slots[]" value="12.00 - 16.30 WIB">
                    12.00 - 16.30 WIB
                </label>
                <label class="checkbox-item">
                    <input type="checkbox" name="time_slots[]" value="16.30 - 00.00 WIB">
                    16.30 - 00.00 WIB
                </label>
                <label class="checkbox-item">
                    <input type="checkbox" name="time_slots[]" value="00.00 - 07.30 WIB">
                    00.00 - 07.30 WIB
                </label>
            </div>
            
            <button type="submit">Ajukan Peminjaman</button>
        </form>
    </div>
</body>
</html>