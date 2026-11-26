<aside class="sidebar">

    {{-- BRAND --}}
    <div class="sidebar-brand">
        <div class="brand-icon">P4MI</div>

        <div class="brand-text">
            <h2>Pengaduan P4MI</h2>
            <p>PORTAL PETUGAS</p>
        </div>
    </div>

    {{-- MENU UTAMA --}}
    <div class="menu-title">MENU UTAMA</div>

    <ul class="sidebar-menu">

        {{-- DASHBOARD --}}
        <li>
            <a href="{{ route('petugas.dashboard') }}"
                class="{{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                <span class="menu-icon">▦</span>
                <span>Dashboard</span>
            </a>
        </li>

    </ul>

    {{-- PENGELOLAAN PENGADUAN --}}
    <div class="menu-title">PENGELOLAAN PENGADUAN</div>

    <ul class="sidebar-menu">

        <li>
            <a href="{{ route('petugas.pengaduan.index') }}"
                class="{{ request()->routeIs(
                    'petugas.pengaduan.*'
               ) ? 'active' : '' }}">

                <span class="menu-icon">▤</span>
                <span>Data Pengaduan</span>

            </a>
        </li>

    </ul>



    {{-- LOGOUT --}}
    <div class="logout-menu">

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="logout-button">
                <span class="menu-icon">↪</span>
                <span>Keluar</span>
            </button>
        </form>

    </div>

</aside>