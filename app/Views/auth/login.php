<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login PINSAKA</title>
    <style>
        body { font-family: Arial; margin: 0; background: #eaf6ff; }
        .wrap { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .card { width: 420px; background: #fff; padding: 32px; border-radius: 18px; box-shadow: 0 10px 30px #0002; }
        .logo { text-align: center; font-size: 30px; font-weight: 800; color: #075985; }
        label { display: block; font-weight: bold; margin: 14px 0 6px; }
        input { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 9px; box-sizing: border-box; }
        .captcha { text-align: center; font-size: 24px; font-weight: bold; letter-spacing: 7px; background: #e0f2fe; padding: 12px; border-radius: 9px; margin-bottom: 10px; }
        button { width: 100%; padding: 13px; margin-top: 18px; background: #075985; color: white; border: 0; border-radius: 9px; font-weight: bold; cursor: pointer; }
        .err { color: #991b1b; background: #fee2e2; padding: 10px; border-radius: 8px; margin-bottom: 10px; text-align: center; }
        .ok { color: #166534; background: #dcfce7; padding: 10px; border-radius: 8px; margin-bottom: 10px; text-align: center; }
        a { color: #075985; font-weight: bold; }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="card">
            <div class="logo">PINSAKA</div>
            <p style="text-align:center">Pengelolaan Sarana dan Prasarana Sabo</p>

            <?php if ($m = session()->getFlashdata('error')) : ?>
                <div class="err"><?= esc($m) ?></div>
            <?php endif; ?>

            <?php if ($m = session()->getFlashdata('success')) : ?>
                <div class="ok"><?= esc($m) ?></div>
            <?php endif; ?>

            <form method="post" action="<?= site_url('login/process') ?>">
                <?= csrf_field() ?>

                <label>Username</label>
                <input type="text" name="username" required placeholder="Masukkan username" value="<?= old('username') ?>">

                <label>Password</label>
                <input type="password" name="password" required placeholder="Masukkan password">

                <label>CAPTCHA</label>
                <div class="captcha"><?= esc(session()->get('captcha')) ?></div>
                <input type="text" name="captcha" placeholder="Masukkan CAPTCHA" required>

                <button type="submit">Masuk</button>
            </form>

            <p style="text-align:center; margin-top: 20px;">
                Belum punya akun? <a href="<?= site_url('register') ?>">Daftar</a>
            </p>
        </div>
    </div>
</body>
</html>