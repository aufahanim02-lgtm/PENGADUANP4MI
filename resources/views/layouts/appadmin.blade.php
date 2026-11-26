```blade
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard Admin - Pengaduan P4MI')</title>

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        a {
            text-decoration: none;
        }

        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }

        /* SIDEBAR */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 255px;
            height: 100vh;
            background: #111827;
            color: white;
            padding: 24px 15px;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            background: #0d6efd;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .brand-text h2 {
            font-size: 16px;
        }

        .brand-text p {
            color: #9ca3af;
            font-size: 10px;
            margin-top: 2px;
        }

        .menu-title {
            color: #6b7280;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 25px 10px 10px;
            letter-spacing: 1px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 4px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 12px;
            color: #aeb7c5;
            border-radius: 9px;
            font-size: 13px;
            transition: 0.2s;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #1f2937;
            color: white;
        }

        .sidebar-menu a.active {
            border-left: 3px solid #0d6efd;
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .logout-menu {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .logout-button {
            width: 100%;
            border: none;
            background: transparent;
            color: #fca5a5;
            cursor: pointer;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 12px;
            border-radius: 9px;
            font-size: 13px;
        }

        .logout-button:hover {
            background: #1f2937;
        }

        /* MAIN */

        .main {
            margin-left: 255px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* CONTENT */

        .content {
            flex: 1;
            padding: 30px;
            width: 100%;
        }

        /* CARD */

        .card {
            background: white;
            border: 1px solid #e7ebf2;
            border-radius: 14px;
        }

        /* RESPONSIVE */

        @media (max-width: 750px) {
            .sidebar {
                width: 70px;
                padding: 20px 8px;
            }

            .brand-text,
            .menu-title,
            .sidebar-menu a span:not(.menu-icon) {
                display: none;
            }

            .sidebar-brand {
                justify-content: center;
                padding-left: 0;
                padding-right: 0;
            }

            .sidebar-menu a {
                justify-content: center;
                padding: 12px;
            }

            .sidebar-menu a.active {
                border-left: none;
            }

            .logout-button {
                justify-content: center;
                text-align: center;
            }

            .main {
                margin-left: 70px;
            }

            .content {
                padding: 18px;
            }
        }

        @media (max-width: 480px) {
            .content {
                padding: 14px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- SIDEBAR --}}
    @include('layouts.admin.sidebar')

    <main class="main">

        {{-- NAVBAR --}}
        @include('layouts.admin.navbar')

        {{-- HALAMAN --}}
        <div class="content">
            @yield('content')
        </div>

        {{-- FOOTER --}}
        @include('layouts.admin.footer')

    </main>

    @stack('scripts')

</body>
</html>
```