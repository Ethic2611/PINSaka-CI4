<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi - PINSAKA</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
        body { background-color: #f8fafc; color: #1e293b; line-height: 1.6; min-height: 100vh; display: flex; flex-direction: column; justify-content: space-between; }

        /* Main Wrapper */
        .wrap { flex: 1; display: flex; align-items: center; justify-content: center; padding: 40px 20px; }
        
        /* Card Form */
        .card { width: 100%; max-width: 440px; background: #ffffff; padding: 36px 32px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); }
        .card-header { text-align: center; margin-bottom: 24px; }
        .logo-title { font-size: 26px; font-weight: 800; color: #075985; display: flex; align-items: center; justify-content: center; gap: 8px; margin-bottom: 6px; }
        .card-title { font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 4px; }
        .card-subtitle { font-size: 14px; color: #64748b; }

        /* Form Elements */
        .form-group { margin-bottom: 18px; text-align: left; }
        label { display: block; font-size: 14px; font-weight: bold; color: #334155; margin-bottom: 6px; }
        input { width: 100%; padding: 11px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; color: #1e293b; background-color: #ffffff; transition: border-color 0.2s, box-shadow 0.2s; outline: none; }
        input:focus { border-color: #075985; box-shadow: 0 0 0 3px rgba(7, 89, 133, 0.1); }
        
        button { width: 100%; padding: 12px; margin-top: 10px; background: #075985; color: #ffffff; border: none; border-radius: 6px; font-size: 14px; font-weight: bold; cursor: pointer; transition: background 0.2s; }
        button:hover { background: #0369a1; }

        /* Alerts */
        .err { color: #991b1b; background: #fee2e2; border: 1px solid #fca5a5; padding: 10px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 16px; text-align: center; }
        .ok { color: #166534; background: #dcfce7; border: 1px solid #86efac; padding: 10px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 16px; text-align: center; }

        /* Footer Links inside card */
        .card-footer { text-align: center; margin-top: 24px; font-size: 14px; color: #64748b; }
        a.link { color: #075985; font-weight: bold; text-decoration: none; }
        a.link:hover { text-decoration: underline; }

        /* Global Footer */
        footer { background: #ffffff; border-top: 1px solid #e2e8f0; text-align: center; padding: 16px; font-size: 13px; color: #64748b; }

        @media (max-width: 480px) {
            .card { padding: 28px 20px; }
        }
    </style>
</head>
<body>

    <!-- Form Container Center -->
    <div class="wrap">
        <div class="card">
            <div class="card-header">
                <div class="logo-title">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="#075985"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    PINSAKA
                </div>
                <h1 class="card-title">Buat Akun Baru</h1>
                <p class="card-subtitle">Silakan isi data untuk mendaftar akun</p>
            </div>

            <?php if ($m = session()->getFlashdata('error')) : ?>
                <div class="err"><?= esc($m) ?></div>
            <?php endif; ?>

            <?php if ($m = session()->getFlashdata('success')) : ?>
                <div class="ok"><?= esc($m) ?></div>
            <?php endif; ?>

            <form method="post" action="<?= site_url('register/process') ?>">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" value="<?= old('name') ?>" required placeholder="Masukkan nama lengkap">
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" value="<?= old('username') ?>" required placeholder="Masukkan username">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" minlength="6" required placeholder="Minimal 6 karakter">
                </div>

                <button type="submit">Daftar</button>
            </form>

            <div class="card-footer">
                Sudah punya akun? <a href="<?= site_url('login') ?>" class="link">Daftar sekarang</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; <?= date('Y') ?> PINSAKA - Balai Teknik Sabo.</p>
    </footer>

</body>
</html>