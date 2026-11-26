<aside class="sidebar">

    {{-- BRAND --}}
    <div class="sidebar-brand">
        <div class="brand-icon">
            P4MI
        </div>

        <div class="brand-text">
            <h2>Pengaduan P4MI</h2>
            <p>ADMINISTRATOR</p>
        </div>
    </div>

    {{-- MENU UTAMA --}}
    <div class="menu-title">
        Menu Utama
    </div>

    <ul class="sidebar-menu">

        {{-- DASHBOARD --}}
        <li>
            <a href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="menu-icon">▦</span>
                <span>Dashboard</span>
            </a>
        </li>

        {{-- DATA USER --}}
        <li>
            <a href="{{ route('admin.user.index') }}"
                class="{{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                <span class="menu-icon">👤</span>
                <span>Data User</span>
            </a>
        </li>

        {{-- DATA PENGADU --}}
        <li>
            <a href="{{ route('admin.pengadu.index') }}"
                class="{{ request()->routeIs('admin.pengadu.*') ? 'active' : '' }}">
                <span class="menu-icon">👥</span>
                <span>Data Pengadu</span>
            </a>
        </li>

        {{-- DATA KATEGORI --}}
        <li>
            <a href="{{ route('admin.kategori.index') }}"
                class="{{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                <span class="menu-icon">🏷</span>
                <span>Kategori</span>
            </a>
        </li>

        {{-- DATA WILAYAH --}}
        <li>
            <a href="{{ route('admin.wilayah.index') }}"
                class="{{ request()->routeIs('admin.wilayah.*') ? 'active' : '' }}">
                <span class="menu-icon">📍</span>
                <span>Wilayah</span>
            </a>
        </li>

    </ul>

    {{-- MENU PENGADUAN --}}
    <div class="menu-title">
        Pengaduan
    </div>

    <ul class="sidebar-menu">

        {{-- DATA PMI --}}
        <li>
            <a href="{{ route('admin.pmi.index') }}"
                class="{{ request()->routeIs('admin.pmi.*') ? 'active' : '' }}">
                <span class="menu-icon">🌍</span>
                <span>Data PMI</span>
            </a>
        </li>

        {{-- DATA PENGADUAN --}}
        <li>
            <a href="{{ route('admin.pengaduan.index') }}"
                class="{{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}">
                <span class="menu-icon">📋</span>
                <span>Data Pengaduan</span>
            </a>
        </li>

        {{-- TINDAK LANJUT --}}
        <li>
            <a href="{{ route('admin.tindaklanjut.index') }}"
                class="{{ request()->routeIs('admin.tindaklanjut.*') ? 'active' : '' }}">
                <span class="menu-icon">📝</span>
                <span>Tindak Lanjut</span>
            </a>
        </li>

        {{-- LAPORAN --}}
        <li>
            <a href="{{ route('admin.laporan.index') }}"
                class="{{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                <span class="menu-icon">📊</span>
                <span>Laporan</span>
            </a>
        </li>

    </ul>

    {{-- LOGOUT --}}
    <div class="logout-menu">

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="logout-button">
                <span class="menu-icon">↪</span>
                <span>Logout</span>
            </button>
        </form>

    </div>

</aside>