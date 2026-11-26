<nav class="top-navbar">

    <div class="navbar-left">

        <button class="sidebar-toggle" id="sidebarToggle" type="button">
            <i class="bi bi-list"></i>
        </button>

        <div>
            <h5 class="navbar-title">
                @yield('page-title', 'Dashboard Pengadu')
            </h5>

            <div class="navbar-subtitle">
                Portal Layanan Pengaduan P4MI
            </div>
        </div>

    </div>

    <div class="navbar-user">

        <div class="navbar-avatar">
            {{ strtoupper(substr(auth('pengadu')->user()->nama ?? 'P', 0, 1)) }}
        </div>

        <div class="navbar-user-info">
            <strong>
                {{ auth('pengadu')->user()->nama ?? 'Pengadu' }}
            </strong>

            <small>Pengguna Pengadu</small>
        </div>

    </div>

</nav>