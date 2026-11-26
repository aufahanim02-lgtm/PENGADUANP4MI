<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('page-title', 'Dashboard Pengadu') | Pengaduan P4MI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #11765d;
            --sidebar-width: 260px;
            --background: #f5f7fa;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            font-family: Arial, sans-serif;
            color: #263238;
        }

        /* SIDEBAR */

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #123d35;
            color: white;
            display: flex;
            flex-direction: column;
            z-index: 1050;
            transition: .3s;
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, .1);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: #16866a;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 23px;
        }

        .brand-text h5 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
        }

        .brand-text small {
            font-size: 10px;
            letter-spacing: 1.5px;
            color: #b8d9cf;
        }

        .sidebar-menu {
            flex: 1;
            padding: 20px 14px;
            overflow-y: auto;
        }

        .menu-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            color: #91b5aa;
            padding: 10px 12px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            margin-bottom: 6px;
            color: #d5e6e0;
            text-decoration: none;
            border-radius: 9px;
            font-size: 13px;
            transition: .2s;
        }

        .sidebar-link i {
            font-size: 17px;
        }

        .sidebar-link:hover {
            color: white;
            background: rgba(255, 255, 255, .1);
        }

        .sidebar-link.active {
            background: #16866a;
            color: white;
            font-weight: 600;
        }

        .notification-count {
            margin-left: auto;
            background: #e74c3c;
            color: white;
            padding: 2px 7px;
            font-size: 10px;
            border-radius: 20px;
        }

        .sidebar-footer {
            padding: 15px;
            border-top: 1px solid rgba(255, 255, 255, .1);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 5px 15px;
        }

        .sidebar-user-icon {
            width: 38px;
            height: 38px;
            background: #16866a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .sidebar-user-info {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .sidebar-user-info strong {
            font-size: 12px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .sidebar-user-info small {
            color: #a9c8bd;
            font-size: 10px;
        }

        .logout-link {
            border: none;
            background: transparent;
            cursor: pointer;
            text-align: left;
        }

        .logout-link:hover {
            background: rgba(231, 76, 60, .2);
            color: #ffb7b0;
        }

        /* MAIN */

        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR */

        .top-navbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid #e9edf0;
            padding: 0 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar-title {
            font-size: 17px;
            font-weight: 700;
            margin: 0;
        }

        .navbar-subtitle {
            font-size: 11px;
            color: #87919a;
            margin-top: 3px;
        }

        .sidebar-toggle {
            border: none;
            background: #edf5f1;
            color: var(--primary);
            width: 38px;
            height: 38px;
            border-radius: 9px;
            font-size: 20px;
            display: none;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-avatar {
            width: 39px;
            height: 39px;
            background: #d9eee6;
            color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .navbar-user-info strong {
            display: block;
            font-size: 12px;
        }

        .navbar-user-info small {
            display: block;
            color: #87919a;
            font-size: 10px;
        }

        /* CONTENT */

        .content-wrapper {
            flex: 1;
            padding: 28px;
        }

        /* FOOTER */

        .main-footer {
            background: white;
            border-top: 1px solid #e9edf0;
            padding: 17px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .main-footer p {
            font-size: 11px;
            color: #87919a;
            margin: 0;
        }

        .main-footer strong {
            color: var(--primary);
        }

        .alert {
            border: none;
            border-radius: 10px;
            font-size: 13px;
        }

        /* RESPONSIVE */

        @media (max-width: 768px) {
            .sidebar {
                left: calc(-1 * var(--sidebar-width));
            }

            .sidebar.show {
                left: 0;
            }

            .main-wrapper {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: block;
            }

            .top-navbar {
                padding: 0 15px;
            }

            .content-wrapper {
                padding: 18px 15px;
            }

            .navbar-user-info {
                display: none;
            }

            .main-footer {
                padding: 15px;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, .4);
                z-index: 1040;
            }

            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar" id="sidebar">
        @include('layouts.pengadu.sidebar')
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- MAIN WRAPPER --}}
    <div class="main-wrapper">

        {{-- NAVBAR --}}
        @include('layouts.pengadu.navbar')

        {{-- CONTENT --}}
        <main class="content-wrapper">

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')

        </main>

        {{-- FOOTER --}}
        @include('layouts.pengadu.footer')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            sidebarOverlay.classList.toggle('show');
        });

        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
        });
    </script>

    @stack('scripts')

</body>

</html>