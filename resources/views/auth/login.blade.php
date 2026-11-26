<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator | Pengaduan P4MI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #eaf3ff, #f8fbff);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1000px;
            min-height: 590px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(30, 64, 175, .12);
        }

        .login-banner {
            background: linear-gradient(145deg, #123c91, #2563eb);
            color: white;
            padding: 55px 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-banner::before,
        .login-banner::after {
            content: "";
            position: absolute;
            border: 1px solid rgba(255,255,255,.13);
            border-radius: 50%;
        }

        .login-banner::before {
            width: 350px;
            height: 350px;
            right: -160px;
            top: -120px;
        }

        .login-banner::after {
            width: 260px;
            height: 260px;
            left: -130px;
            bottom: -100px;
        }

        .brand-symbol {
            width: 72px;
            height: 72px;
            border-radius: 20px;
            background: rgba(255,255,255,.16);
            border: 1px solid rgba(255,255,255,.25);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            font-weight: 800;
            margin-bottom: 30px;
        }

        .login-banner h1 {
            font-size: 31px;
            font-weight: 800;
            line-height: 1.4;
            margin-bottom: 18px;
        }

        .login-banner p {
            color: #dbeafe;
            line-height: 1.9;
            font-size: 14px;
        }

        .banner-note {
            margin-top: 45px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,.2);
            color: #dbeafe;
            font-size: 12px;
        }

        .login-form-area {
            padding: 55px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-heading {
            margin-bottom: 35px;
        }

        .login-heading span {
            color: #2563eb;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
        }

        .login-heading h2 {
            color: #172554;
            font-size: 27px;
            font-weight: 800;
            margin: 10px 0;
        }

        .login-heading p {
            color: #64748b;
            font-size: 13px;
        }

        .form-label {
            color: #334155;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .form-control {
            height: 52px;
            border: 1px solid #dbe3ef;
            border-radius: 11px;
            font-size: 13px;
            padding: 12px 15px;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.10);
        }

        .login-button {
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 11px;
            background: #2563eb;
            color: white;
            font-weight: 700;
            font-size: 14px;
            margin-top: 12px;
            transition: .2s;
        }

        .login-button:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .login-footer {
            text-align: center;
            color: #94a3b8;
            font-size: 11px;
            margin-top: 35px;
        }

        @media (max-width: 768px) {
            .login-wrapper {
                grid-template-columns: 1fr;
                max-width: 470px;
            }

            .login-banner {
                padding: 35px;
                min-height: 250px;
            }

            .login-banner h1 {
                font-size: 24px;
            }

            .banner-note {
                margin-top: 20px;
            }

            .login-form-area {
                padding: 40px 30px;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="login-banner">
        <div class="brand-symbol">P4</div>

        <h1>APLIKASI<br>PENGADUAN P4MI</h1>

        <p>
            Sistem informasi pelayanan pengaduan Pekerja Migran Indonesia.
            Kelola laporan, data PMI, dan tindak lanjut pengaduan dalam satu sistem.
        </p>

        <div class="banner-note">
            Pusat Pelayanan dan Perlindungan Pekerja Migran Indonesia
        </div>
    </div>

    <div class="login-form-area">

        <div class="login-heading">
            <span>ADMINISTRATOR AREA</span>
            <h2>Selamat Datang!</h2>
            <p>Silakan masuk menggunakan akun Administrator.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success small">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger small">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger small">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.proses') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="form-label">Username</label>
                <input
                    type="text"
                    name="username"
                    class="form-control"
                    placeholder="Masukkan username"
                    value="{{ old('username') }}"
                    autocomplete="username"
                    required
                    autofocus
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button type="submit" class="login-button">
                Masuk ke Dashboard
            </button>
        </form>

        <div class="login-footer">
            &copy; {{ date('Y') }} Aplikasi Pengaduan P4MI. All Rights Reserved.
        </div>

    </div>
</div>

</body>
</html>
