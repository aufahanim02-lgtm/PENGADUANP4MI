<div class="sidebar-header">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="bi bi-shield-check"></i>
        </div>

        <div class="brand-text">
            <h5>Pengaduan P4MI</h5>
            <small>PORTAL PENGADU</small>
        </div>
    </div>
</div>

<div class="sidebar-menu">

    {{-- MENU UTAMA --}}
    <div class="menu-label">MENU UTAMA</div>

    {{-- DASHBOARD --}}
    <a href="{{ route('pengadu.dashboard') }}"
        class="sidebar-link {{ request()->routeIs('pengadu.dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid-fill"></i>
        <span>Dashboard</span>
    </a>

    {{-- MENU PENGADUAN --}}
    <div class="menu-label mt-4">LAYANAN PENGADUAN</div>

    <a href="{{ route('pengadu.pengaduan.index') }}"
        class="sidebar-link {{ request()->routeIs('pengadu.pengaduan.*') ? 'active' : '' }}">
        <i class="bi bi-megaphone-fill"></i>
        <span>Pengaduan Saya</span>
    </a>

    {{-- DATA PMI --}}
    <a href="{{ route('pengadu.pmi.index') }}"
        class="sidebar-link {{ request()->routeIs('pengadu.pmi.*') ? 'active' : '' }}">
        <i class="bi bi-person-vcard-fill"></i>
        <span>Data PMI</span>
    </a>

    {{-- NOTIFIKASI --}}
    <div class="menu-label mt-4">INFORMASI</div>

    <a href="{{ route('pengadu.notifikasi.index') }}"
        class="sidebar-link {{ request()->routeIs('pengadu.notifikasi.*') ? 'active' : '' }}">

        <i class="bi bi-bell-fill"></i>
        <span>Notifikasi</span>

        @php
        $jumlahNotifikasi = \App\Models\ModelNotifikasi::where(
        'idpengadu',
        auth('pengadu')->id()
        )
        ->where('dibaca', false)
        ->count();
        @endphp

        @if($jumlahNotifikasi > 0)
        <span class="notification-count">
            {{ $jumlahNotifikasi > 99 ? '99+' : $jumlahNotifikasi }}
        </span>
        @endif
    </a>

    {{-- PENGATURAN --}}
    <div class="menu-label mt-4">PENGATURAN</div>

    <a href="{{ route('pengadu.profil.edit') }}"
        class="sidebar-link {{ request()->routeIs('pengadu.profil.*') ? 'active' : '' }}">
        <i class="bi bi-person-circle"></i>
        <span>Profil Saya</span>
    </a>

</div>

{{-- FOOTER SIDEBAR --}}
<div class="sidebar-footer">

    <div class="sidebar-user">

        <div class="sidebar-user-icon">
            {{ strtoupper(substr(auth('pengadu')->user()->nama ?? 'P', 0, 1)) }}
        </div>

        <div class="sidebar-user-info">
            <strong>
                {{ auth('pengadu')->user()->nama ?? 'Pengadu' }}
            </strong>
            <small>Pengguna Pengadu</small>
        </div>

    </div>

    {{-- LOGOUT --}}
    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <button type="submit" class="sidebar-link logout-link w-100">
            <i class="bi bi-box-arrow-left"></i>
            <span>Keluar</span>
        </button>
    </form>

</div>