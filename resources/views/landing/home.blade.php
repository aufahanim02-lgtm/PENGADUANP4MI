
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengaduan P4MI | Pelayanan Pengaduan PMI</title>

    <meta name="description" content="Aplikasi Pengaduan P4MI untuk membantu pelayanan, pelaporan, dan penanganan pengaduan Pekerja Migran Indonesia.">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #1e293b;
            background: #fff;
        }

        .navbar {
            background: rgba(255,255,255,.97);
            padding: 15px 0;
            box-shadow: 0 3px 18px rgba(15,23,42,.05);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #173f91;
            font-size: 17px;
            font-weight: 800;
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            border-radius: 12px;
            background: #2563eb;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 16px;
        }

        .brand-caption {
            display: block;
            color: #64748b;
            font-size: 9px;
            font-weight: 500;
            letter-spacing: .7px;
            margin-top: 2px;
        }

        .navbar-nav .nav-link {
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            margin: 0 10px;
        }

        .navbar-nav .nav-link:hover {
            color: #2563eb;
        }

        .btn-login {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 9px;
            padding: 11px 23px;
            font-size: 13px;
            font-weight: 700;
            transition: .2s;
        }

        .btn-login:hover {
            background: #1d4ed8;
            color: white;
            transform: translateY(-2px);
        }

        .hero {
            min-height: 610px;
            padding: 90px 0;
            background:
                radial-gradient(circle at 90% 15%, rgba(96,165,250,.22), transparent 27%),
                linear-gradient(125deg, #eff6ff 0%, #ffffff 58%, #eaf3ff 100%);
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero-label {
            display: inline-block;
            padding: 8px 14px;
            background: #dbeafe;
            color: #1d4ed8;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .5px;
            margin-bottom: 22px;
        }

        .hero h1 {
            color: #142f68;
            font-size: clamp(34px, 5vw, 52px);
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 20px;
        }

        .hero h1 span {
            color: #2563eb;
        }

        .hero-description {
            max-width: 540px;
            color: #64748b;
            font-size: 14px;
            line-height: 2;
            margin-bottom: 30px;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 13px;
        }

        .btn-primary-custom {
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 14px 23px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            transition: .2s;
        }

        .btn-primary-custom:hover {
            background: #1d4ed8;
            color: white;
            transform: translateY(-2px);
        }

        .btn-outline-custom {
            border: 1px solid #cbd5e1;
            color: #334155;
            text-decoration: none;
            padding: 14px 23px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            background: white;
        }

        .btn-outline-custom:hover {
            border-color: #2563eb;
            color: #2563eb;
        }

        .hero-visual {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 390px;
        }

        .hero-main-card {
            position: relative;
            width: 100%;
            max-width: 420px;
            min-height: 340px;
            background: linear-gradient(145deg, #1e40af, #3b82f6);
            border-radius: 30px;
            padding: 35px;
            color: white;
            box-shadow: 0 25px 55px rgba(37,99,235,.23);
            overflow: hidden;
        }

        .hero-main-card::before {
            content: "";
            position: absolute;
            width: 250px;
            height: 250px;
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 50%;
            right: -80px;
            top: -90px;
        }

        .hero-card-icon {
            width: 70px;
            height: 70px;
            background: rgba(255,255,255,.16);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin-bottom: 35px;
        }

        .hero-main-card h3 {
            font-size: 24px;
            font-weight: 800;
            line-height: 1.5;
            margin-bottom: 12px;
        }

        .hero-main-card p {
            color: #dbeafe;
            font-size: 12px;
            line-height: 1.9;
        }

        .hero-card-footer {
            border-top: 1px solid rgba(255,255,255,.2);
            margin-top: 28px;
            padding-top: 18px;
            font-size: 11px;
            color: #dbeafe;
        }

        .section {
            padding: 85px 0;
        }

        .section-heading {
            text-align: center;
            max-width: 650px;
            margin: 0 auto 45px;
        }

        .section-label {
            color: #2563eb;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .section-heading h2 {
            color: #172554;
            font-size: 30px;
            font-weight: 800;
            margin: 12px 0;
        }

        .section-heading p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.9;
        }

        .service-card {
            height: 100%;
            border: 1px solid #e5edf8;
            border-radius: 17px;
            padding: 27px 23px;
            background: white;
            transition: .25s;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(15,23,42,.07);
            border-color: #bfdbfe;
        }

        .service-icon {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: #dbeafe;
            color: #2563eb;
            font-size: 23px;
            margin-bottom: 20px;
        }

        .service-card h3 {
            color: #1e293b;
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 11px;
        }

        .service-card p {
            color: #64748b;
            font-size: 12px;
            line-height: 1.9;
            margin: 0;
        }

        .steps-section {
            background: #f8fbff;
        }

        .step-card {
            text-align: center;
            padding: 25px 20px;
        }

        .step-number {
            width: 55px;
            height: 55px;
            margin: 0 auto 18px;
            border-radius: 50%;
            background: #2563eb;
            color: white;
            font-size: 20px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .step-card h3 {
            font-size: 14px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .step-card p {
            color: #64748b;
            font-size: 12px;
            line-height: 1.8;
        }

        .cta-section {
            padding: 65px 0;
        }

        .cta-box {
            background: linear-gradient(120deg, #173f91, #2563eb);
            border-radius: 22px;
            padding: 48px 35px;
            text-align: center;
            color: white;
        }

        .cta-box h2 {
            font-size: 27px;
            font-weight: 800;
            margin-bottom: 13px;
        }

        .cta-box p {
            color: #dbeafe;
            font-size: 13px;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .cta-button {
            display: inline-block;
            text-decoration: none;
            background: white;
            color: #1d4ed8;
            padding: 13px 25px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 800;
        }

        .cta-button:hover {
            background: #eff6ff;
            color: #1d4ed8;
        }

        footer {
            background: #102653;
            color: white;
            padding: 35px 0;
        }

        .footer-brand {
            font-size: 17px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .footer-description {
            color: #cbd5e1;
            font-size: 11px;
            line-height: 1.9;
            max-width: 430px;
        }

        .footer-copy {
            border-top: 1px solid rgba(255,255,255,.13);
            margin-top: 25px;
            padding-top: 20px;
            color: #cbd5e1;
            font-size: 11px;
            text-align: center;
        }

        @media (max-width: 991px) {
            .hero {
                padding: 65px 0;
            }

            .hero-visual {
                margin-top: 35px;
            }
        }

        @media (max-width: 576px) {
            .hero {
                padding: 55px 0;
            }

            .hero h1 {
                font-size: 34px;
            }

            .hero-main-card {
                padding: 27px;
                min-height: 300px;
            }

            .section {
                padding: 65px 0;
            }

            .section-heading h2 {
                font-size: 24px;
            }

            .cta-box {
                padding: 38px 22px;
            }

            .cta-box h2 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">

        <a class="navbar-brand" href="{{ route('landing.home') }}">
            <div class="brand-icon">P4</div>
            <div>
                PENGADUAN P4MI
                <span class="brand-caption">PELAYANAN PENGADUAN PMI</span>
            </div>
        </a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarMenu"
            aria-controls="navbarMenu" aria-expanded="false"
            aria-label="Buka navigasi">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" href="#beranda">Beranda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#layanan">Layanan</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#alur">Alur Pengaduan</a>
                </li>

                <li class="nav-item ms-lg-2">
                    <a href="{{ route('login') }}" class="btn-login">
                        Login
                    </a>
                </li>

            </ul>

        </div>
    </div>
</nav>

{{-- HERO --}}
<section class="hero" id="beranda">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6">

                <span class="hero-label">
                    SISTEM INFORMASI PELAYANAN P4MI
                </span>

                <h1>
                    Pelayanan Pengaduan
                    <span>Pekerja Migran Indonesia</span>
                </h1>

                <p class="hero-description">
                    Aplikasi Pengaduan P4MI merupakan sistem informasi
                    untuk membantu proses penyampaian, pencatatan,
                    pemantauan, dan penanganan pengaduan Pekerja Migran
                    Indonesia secara lebih terstruktur.
                </p>

                <div class="hero-actions">
                    <a href="{{ route('login') }}" class="btn-primary-custom">
                        Masuk ke Sistem
                        <span>→</span>
                    </a>

                    <a href="#layanan" class="btn-outline-custom">
                        Pelajari Layanan
                    </a>
                </div>

            </div>

            <div class="col-lg-6">

                <div class="hero-visual">

                    <div class="hero-main-card">

                        <div class="hero-card-icon">P4</div>

                        <h3>
                            Layanan Pengaduan
                            P4MI
                        </h3>

                        <p>
                            Mendukung pelayanan pengaduan PMI melalui
                            pencatatan laporan, pengelolaan data,
                            pemantauan status, dan tindak lanjut.
                        </p>

                        <div class="hero-card-footer">
                            PELAYANAN • PERLINDUNGAN • PENANGANAN
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</section>

{{-- LAYANAN --}}
<section class="section" id="layanan">
    <div class="container">

        <div class="section-heading">

            <span class="section-label">LAYANAN SISTEM</span>

            <h2>Fitur Pelayanan Pengaduan</h2>

            <p>
                Sistem dirancang untuk membantu pengelolaan informasi
                pengaduan PMI mulai dari pencatatan laporan hingga
                proses penanganan.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-6 col-lg-4">
                <div class="service-card">
                    <div class="service-icon">▤</div>
                    <h3>Pencatatan Pengaduan</h3>
                    <p>
                        Mendukung pencatatan laporan pengaduan
                        yang disampaikan oleh pelapor.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="service-card">
                    <div class="service-icon">♙</div>
                    <h3>Data Pekerja Migran</h3>
                    <p>
                        Pengelolaan informasi PMI yang berkaitan
                        dengan laporan pengaduan.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="service-card">
                    <div class="service-icon">▣</div>
                    <h3>Bukti Pengaduan</h3>
                    <p>
                        Mendukung penyimpanan dokumen dan bukti
                        pendukung laporan.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="service-card">
                    <div class="service-icon">✓</div>
                    <h3>Tindak Lanjut</h3>
                    <p>
                        Membantu petugas mencatat perkembangan
                        dan proses penanganan pengaduan.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="service-card">
                    <div class="service-icon">◷</div>
                    <h3>Pemantauan Status</h3>
                    <p>
                        Memudahkan pemantauan status pengaduan
                        sesuai tahapan penanganannya.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="service-card">
                    <div class="service-icon">▥</div>
                    <h3>Laporan Pengaduan</h3>
                    <p>
                        Mendukung pengelolaan informasi dan
                        rekapitulasi data pengaduan.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ALUR --}}
<section class="section steps-section" id="alur">
    <div class="container">

        <div class="section-heading">

            <span class="section-label">ALUR PELAYANAN</span>

            <h2>Alur Pengaduan</h2>

            <p>
                Berikut gambaran umum tahapan pengelolaan
                pengaduan melalui sistem P4MI.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-6 col-lg-3">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h3>Masuk ke Sistem</h3>
                    <p>
                        Pengguna masuk menggunakan akun yang telah tersedia.
                    </p>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h3>Menyampaikan Laporan</h3>
                    <p>
                        Pengadu mengisi informasi pengaduan dan
                        melampirkan bukti pendukung jika tersedia.
                    </p>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h3>Verifikasi Petugas</h3>
                    <p>
                        Petugas memeriksa informasi dan
                        kelengkapan pengaduan.
                    </p>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="step-card">
                    <div class="step-number">4</div>
                    <h3>Tindak Lanjut</h3>
                    <p>
                        Pengaduan diproses dan perkembangannya
                        dicatat dalam sistem.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- CTA LOGIN --}}
<section class="cta-section">
    <div class="container">

        <div class="cta-box">

            <h2>Selamat Datang di Aplikasi Pengaduan P4MI</h2>

            <p>
                Silakan masuk ke sistem untuk mengakses layanan
                sesuai dengan hak akses akun masing-masing.
            </p>

            <a href="{{ route('login') }}" class="cta-button">
                Login Sekarang →
            </a>

        </div>

    </div>
</section>

{{-- FOOTER --}}
<footer>
    <div class="container">

        <div class="footer-brand">
            APLIKASI PENGADUAN P4MI
        </div>

        <p class="footer-description">
            Sistem informasi pelayanan pengaduan Pekerja Migran
            Indonesia untuk mendukung pengelolaan laporan,
            pemantauan, dan tindak lanjut pengaduan.
        </p>

        <div class="footer-copy">
            &copy; {{ date('Y') }} Aplikasi Pengaduan P4MI.
            Seluruh hak cipta dilindungi.
        </div>

    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
