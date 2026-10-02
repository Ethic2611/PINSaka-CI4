<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PINSAKA - Peminjaman Sarana dan Prasarana</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
        html { scroll-behavior: smooth; }
        body { background-color: #f8fafc; color: #1e293b; line-height: 1.6; }

        /* Navigation Bar */
        .navbar { position: sticky; top: 0; z-index: 1000; display: flex; justify-content: space-between; align-items: center; padding: 16px 40px; background: #ffffff; border-bottom: 1px solid #e2e8f0; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
        .logo { font-size: 20px; font-weight: 800; color: #075985; display: flex; align-items: center; gap: 8px; text-decoration: none; }
        .nav-links { display: flex; align-items: center; gap: 24px; }
        .nav-links a { text-decoration: none; color: #475569; font-size: 14px; font-weight: 500; transition: color 0.2s; }
        .nav-links a:hover { color: #075985; }
        .auth-btns { display: flex; gap: 12px; }
        .btn-login { background: #075985; color: #ffffff; padding: 8px 18px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: bold; transition: background 0.2s; }
        .btn-login:hover { background: #0369a1; }
        .btn-register { background: #ffffff; color: #075985; border: 1px solid #cbd5e1; padding: 8px 18px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: bold; transition: background 0.2s; }
        .btn-register:hover { background: #f1f5f9; }

        /* Main Container */
        .container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }

        /* Section Styling */
        .section-title { font-size: 24px; font-weight: 800; color: #0f172a; margin-bottom: 12px; text-align: center; }
        .section-desc { font-size: 15px; color: #64748b; text-align: center; max-width: 700px; margin: 0 auto 32px; }
        .content-card { background: #ffffff; padding: 32px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 40px; }

        /* Hero Section */
        .hero { display: flex; align-items: center; justify-content: space-between; gap: 40px; background: #ffffff; padding: 40px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px; }
        .hero-text { flex: 1; }
        .hero-title { font-size: 38px; font-weight: 800; color: #0f172a; margin-bottom: 8px; }
        .hero-subtitle { font-size: 16px; font-weight: bold; color: #334155; margin-bottom: 8px; }
        .hero-desc { font-size: 14px; color: #64748b; margin-bottom: 24px; line-height: 1.5; max-width: 420px; }
        .btn-action { display: inline-block; background: #075985; color: #ffffff; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 14px; transition: background 0.2s; }
        .btn-action:hover { background: #0369a1; }
        .hero-image { flex: 1; text-align: right; }
        .hero-image img { width: 100%; max-width: 450px; border-radius: 8px; background: #e2e8f0; }

        /* Feature Cards Grid */
        .features { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 40px; }
        .feature-card { background: #ffffff; padding: 24px; border-radius: 12px; border: 1px solid #e2e8f0; text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center; }
        .feature-icon { width: 48px; height: 48px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px; }
        .feature-icon svg { width: 24px; height: 24px; fill: #075985; }
        .feature-title { font-size: 15px; font-weight: bold; color: #1e293b; }

        /* Layanan Grid Detail */
        .services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
        .service-item { background: #f8fafc; padding: 24px; border-radius: 10px; border: 1px solid #e2e8f0; text-align: left; }
        .service-item h3 { font-size: 18px; color: #075985; margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }
        .service-item p { font-size: 14px; color: #475569; }

        /* Kontak Grid */
        .contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
        .contact-info { display: flex; flex-direction: column; gap: 16px; }
        .contact-item { display: flex; align-items: flex-start; gap: 14px; }
        .contact-icon { width: 40px; height: 40px; background: #e0f2fe; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .contact-icon svg { width: 20px; height: 20px; fill: #075985; }
        .contact-text h4 { font-size: 15px; color: #0f172a; margin-bottom: 2px; }
        .contact-text p { font-size: 14px; color: #64748b; }

        /* Footer */
        footer { background: #ffffff; border-top: 1px solid #e2e8f0; text-align: center; padding: 20px; font-size: 13px; color: #64748b; margin-top: 40px; }

        @media (max-width: 768px) {
            .hero { flex-direction: column; text-align: center; }
            .hero-desc { margin: 0 auto 24px; }
            .features, .services-grid, .contact-grid { grid-template-columns: 1fr; }
            .navbar { padding: 16px 20px; flex-wrap: wrap; gap: 12px; }
            .nav-links { gap: 14px; }
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <a href="#beranda" class="logo">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="#075985"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            PINSAKA
        </a>
        <div class="nav-links">
            <a href="#beranda">Beranda</a>
            <a href="#tentang">Tentang</a>
            <a href="#layanan">Layanan</a>
            <a href="#kontak">Kontak</a>
        </div>
        <div class="auth-btns">
            <a href="<?= site_url('auth/login') ?>" class="btn-login"> </a>
            <a href="<?= site_url('auth/register') ?>" class="btn-register"></a>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container">
        
        <!-- Hero Section (Beranda) -->
        <section id="beranda" style="scroll-margin-top: 90px;">
            <div class="hero">
                <div class="hero-text">
                    <h1 class="hero-title">PINSAKA</h1>
                    <div class="hero-subtitle">Peminjaman Sarana dan Prasarana</div>
                    <p class="hero-desc">Kelola peminjaman ruangan, kendaraan dan pelaporan kerusakan dengan mudah dan cepat.</p>
                    <a href="<?= site_url('login') ?>" class="btn-action">Ajukan Peminjaman</a>
                </div>
                <div class="hero-image">
                    <img src="<?= base_url('assets/images/building-placeholder.jpg') ?>" alt="Gedung Sabo" onerror="this.src='https://via.placeholder.com/450x260?text=Gambar+Gedung+Sabo'">
                </div>
            </div>

            <!-- 3 Feature Cards -->
            <div class="features">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/></svg>
                    </div>
                    <div class="feature-title">Peminjaman Ruangan</div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/></svg>
                    </div>
                    <div class="feature-title">Peminjaman Kendaraan</div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24"><path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.6C.4 7 1 10 3 12c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.4-.4.4-1.1 0-1.3z"/></svg>
                    </div>
                    <div class="feature-title">Pelaporan Kerusakan</div>
                </div>
            </div>
        </section>

        <!-- Section Tentang -->
        <section id="tentang" style="scroll-margin-top: 90px;">
            <div class="content-card">
                <h2 class="section-title">Tentang PINSAKA</h2>
                <p class="section-desc">
                    PINSAKA (Pengelolaan Sarana dan Prasarana Sabo) adalah sistem informasi terpadu yang dirancang untuk mempermudah alur peminjaman fasilitas serta pemeliharaan aset kerja secara transparan, akurat, dan terintegrasi.
                </p>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                    <div style="background: #f8fafc; padding: 20px; border-radius: 8px; border-left: 4px solid #075985;">
                        <h4 style="color: #075985; margin-bottom: 8px;">Efisiensi Digital</h4>
                        <p style="font-size: 14px; color: #64748b;">Memangkas proses birokrasi peminjaman manual menjadi digital dan dapat dipantau status verifikasinya secara real-time.</p>
                    </div>
                    <div style="background: #f8fafc; padding: 20px; border-radius: 8px; border-left: 4px solid #075985;">
                        <h4 style="color: #075985; margin-bottom: 8px;">Transparansi Jadwal</h4>
                        <p style="font-size: 14px; color: #64748b;">Mencegah terjadinya bentrok jadwal penggunaan fasilitas antar bagian internal melalui kalender peminjaman terpusat.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Layanan -->
        <section id="layanan" style="scroll-margin-top: 90px;">
            <div class="content-card">
                <h2 class="section-title">Layanan Utama</h2>
                <p class="section-desc">Nikmati kemudahan akses berbagai layanan sarana dan prasarana dalam satu platform.</p>
                
                <div class="services-grid">
                    <div class="service-item">
                        <h3>🏢 Peminjaman Ruangan</h3>
                        <p>Akses reservasi berbagai ruang rapat, auditorium, hingga ruang diskusi dengan pilihan jam dan tanggal yang fleksibel.</p>
                    </div>
                    <div class="service-item">
                        <h3>🚗 Peminjaman Kendaraan</h3>
                        <p>Pengajuan armada kendaraan operasional kantor untuk keperluan dinas lapangan secara resmi dan terstruktur.</p>
                    </div>
                    <div class="service-item">
                        <h3>🛠️ Pelaporan Kerusakan</h3>
                        <p>Layanan aduan kerusakan fasilitas kantor atau peralatan kerja agar segera mendapat penanganan dari tim pemeliharaan.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Kontak -->
        <section id="kontak" style="scroll-margin-top: 90px;">
            <div class="content-card">
                <h2 class="section-title">Hubungi Kami</h2>
                <p class="section-desc">Butuh bantuan atau informasi lebih lanjut terkait pengelolaan sarana? Tim kami siap membantu Anda.</p>
                
                <div class="contact-grid">
                    <div class="contact-info">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                            </div>
                            <div class="contact-text">
                                <h4>Alamat Kantor</h4>
                                <p>Balai Teknik Sabo, Jl. Sopalan, Maguwoharjo, Depok, Sleman, DI Yogyakarta 55282</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                            </div>
                            <div class="contact-text">
                                <h4>Email Resmi</h4>
                                <p>pinsaka@sabo.go.id / info@pinsaka.id</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                            </div>
                            <div class="contact-text">
                                <h4>Telepon / WhatsApp</h4>
                                <p>(0274) 885123 / +62 812-3456-7890</p>
                            </div>
                        </div>
                    </div>

                    <div style="background: #f8fafc; padding: 20px; border-radius: 10px; border: 1px solid #cbd5e1;">
                        <h4 style="margin-bottom: 10px; color: #075985;">Jam Operasional Layanan</h4>
                        <ul style="list-style: none; font-size: 14px; color: #475569; display: flex; flex-direction: column; gap: 8px;">
                            <li><strong>Senin - Kamis:</strong> 07.30 - 16.00 WIB</li>
                            <li><strong>Jumat:</strong> 07.30 - 16.30 WIB</li>
                            <li><strong>Sabtu - Minggu:</strong> Libur (Kecuali Acara Khusus)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; <?= date('Y') ?> PINSAKA - Balai Teknik Sabo. Seluruh Hak Cipta Dilindungi.</p>
    </footer>

</body>
</html>