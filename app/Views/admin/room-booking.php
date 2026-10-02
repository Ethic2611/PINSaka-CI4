<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Peminjaman Ruangan - PINSAKA</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eaf6ff; margin: 0; padding: 20px 0; }
        .box { max-width: 750px; margin: 20px auto; background: #fff; padding: 35px; border-radius: 18px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
        h1 { color: #075985; margin-top: 0; }
        label { display: block; font-weight: bold; margin: 16px 0 6px; color: #1e293b; }
        input, select, textarea { width: 100%; box-sizing: border-box; padding: 12px; border: 1px solid #cbd5e1; border-radius: 9px; font-size: 14px; }
        textarea { resize: vertical; height: 90px; }
        .row { display: flex; gap: 15px; }
        .col { flex: 1; }
        
        .room-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px; margin-top: 8px; }
        .room-card { border: 2px solid #e2e8f0; border-radius: 12px; padding: 12px; cursor: pointer; transition: all 0.2s; display: flex; flex-direction: column; align-items: flex-start; }
        .room-card:hover { border-color: #075985; background: #f0f9ff; }
        .room-card input[type="radio"] { width: auto; margin-right: 8px; cursor: pointer; }
        .room-card img { width: 100%; height: 160px; object-fit: cover; border-radius: 8px; margin-bottom: 10px; background-color: #e2e8f0; }
        .room-info { font-weight: bold; color: #0f172a; display: flex; align-items: center; }
        
        .radio-group { display: flex; flex-direction: column; gap: 8px; margin-top: 6px; }
        .radio-label { display: flex; align-items: center; font-weight: normal; margin: 0; cursor: pointer; }
        .radio-label input { width: auto; margin-right: 10px; }

        button { width: 100%; padding: 14px; background: #075985; color: #fff; border: 0; border-radius: 9px; font-weight: bold; font-size: 16px; margin-top: 25px; cursor: pointer; }
        button:hover { background: #0369a1; }
        .back-link { display: inline-block; margin-bottom: 15px; color: #075985; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="box">
    <a href="<?= site_url('dashboard') ?>" class="back-link">← Kembali ke Dashboard</a>
    <h1>Peminjaman Ruang Rapat</h1>

    <form method="post" action="<?= site_url('booking/save') ?>">
        <?= csrf_field() ?>
        <input type="hidden" name="type" value="Ruangan">

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

        <!-- 2. Pilihan Ruangan Visual Card -->
        <label>6. NAMA RUANGAN *</label>
        <div class="room-grid">
            <?php if (!empty($rooms)): ?>
                <?php foreach ($rooms as $r): ?>
                    <label class="room-card">
                        <img src="<?= base_url('uploads/rooms/' . ($r['image'] ?? 'default.jpg')) ?>" loading="lazy" alt="<?= esc($r['name']) ?>">
                        <div class="room-info">
                            <input type="radio" name="item" value="<?= esc($r['name']) ?>" required>
                            <?= esc($r['name']) ?> (Kapasitas <?= esc($r['capacity']) ?>)
                        </div>
                    </label>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Fallback opsi jika data $rooms dari controller belum dimasukkan -->
                <label class="room-card">
                    <img src="<?= base_url('uploads/rooms/merapi-k50.jpeg') ?>" loading="lazy" alt="Merapi" onerror="this.style.display='none'">
                    <div class="room-info">
                        <input type="radio" name="item" value="Media Center Auditorium Merapi" required>
                        Media Center Auditorium Merapi (Kapasitas 50)
                    </div>
                </label>
                <label class="room-card">
                    <img src="<?= base_url('uploads/rooms/semeru-30.jpeg') ?>" loading="lazy" alt="Semeru" onerror="this.style.display='none'">
                    <div class="room-info">
                        <input type="radio" name="item" value="Ruang Rapat Semeru" required>
                        Ruang Rapat Semeru (Kapasitas 30)
                    </div>
                </label>
                <label class="room-card">
                    <img src="<?= base_url('uploads/rooms/kelud.jpeg') ?>" loading="lazy" alt="Kelud" onerror="this.style.display='none'">
                    <div class="room-info">
                        <input type="radio" name="item" value="Ruang Rapat Kelud" required>
                        Ruang Rapat Kelud (Kapasitas 15)
                    </div>
                </label>
                <label class="room-card">
                    <img src="<?= base_url('uploads/rooms/sinabung-16.jpeg') ?>" loading="lazy" alt="Sinabung" onerror="this.style.display='none'">
                    <div class="room-info">
                        <input type="radio" name="item" value="Ruang Rapat Sinabung" required>
                        Ruang Rapat Sinabung (Kapasitas 16)
                    </div>
                </label>
                <label class="room-card">
                    <img src="<?= base_url('uploads/rooms/galunggung.jpg') ?>" loading="lazy" alt="Galunggung" onerror="this.style.display='none'">
                    <div class="room-info">
                        <input type="radio" name="item" value="Ruang Rapat Galunggung" required>
                        Ruang Rapat Galunggung (Kapasitas 10)
                    </div>
                </label>
                <label class="room-card">
                    <img src="<?= base_url('uploads/rooms/kerinci.jpeg') ?>" loading="lazy" alt="Kerinci" onerror="this.style.display='none'">
                    <div class="room-info">
                        <input type="radio" name="item" value="Ruang Rapat Kerinci" required>
                        Ruang Rapat Kerinci (Kapasitas 14)
                    </div>
                </label>
                <label class="room-card">
                    <img src="<?= base_url('uploads/rooms/matshusita hall.jpeg') ?>" loading="lazy" alt="Matsushita Hall" onerror="this.style.display='none'">
                    <div class="room-info">
                        <input type="radio" name="item" value="Ruang Rapat Matsushita Hall" required>
                        Ruang Rapat Matsushita Hall (Kapasitas 100)
                    </div>
                </label>
            <?php endif; ?>
        </div>

        <!-- 3. Detail Acara & Waktu -->
        <label>7. KEPERLUAN PEMINJAMAN RUANGAN *</label>
        <textarea name="purpose" required placeholder="Diisi keterangan nama kegiatan rapat"></textarea>

        <label>8. JUMLAH PERSONIL RUANGAN *</label>
        <input type="number" name="personnel_count" min="1" required placeholder="Masukkan jumlah peserta">

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

        <label>11. WAKTU PEMINJAMAN RUANGAN *</label>
        <div class="radio-group">
            <label class="radio-label">
                <input type="radio" name="time_slot" value="07.30-12.00" required> 07.30 - 12.00
            </label>
            <label class="radio-label">
                <input type="radio" name="time_slot" value="12.00-16.30"> 12.00 - 16.30
            </label>
            <label class="radio-label">
                <input type="radio" name="time_slot" value="07.30-16.30"> 07.30 - 16.30 (Penuh Hari)
            </label>
        </div>

        <button type="submit">Ajukan Peminjaman</button>
    </form>
</div>

</body>
</html>