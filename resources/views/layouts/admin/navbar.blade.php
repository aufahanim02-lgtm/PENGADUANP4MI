
<header class="admin-topbar">

    {{-- Bagian Judul Halaman --}}
    <div class="admin-page-title">

        <h1>
            @yield('page-title', 'Dashboard Admin')
        </h1>

        <p>
            @yield('page-description', 'Sistem Informasi Pengaduan P4MI')
        </p>

    </div>

    {{-- Profil Admin --}}
    <div class="admin-topbar-profile">

        <div class="admin-profile-avatar">
            {{ strtoupper(substr(auth('user')->user()->nama ?? 'A', 0, 1)) }}
        </div>

        <div class="admin-profile-info">

            <strong>
                {{ auth('user')->user()->nama ?? 'Administrator' }}
            </strong>

            <span>
                <i class="bi bi-shield-check"></i>
                Administrator
            </span>

        </div>

    </div>

</header>


<style>
    /* ==============================
       ADMIN TOPBAR
    ============================== */

    .admin-topbar {
        min-height: 76px;
        width: 100%;
        background: #ffffff;
        border-bottom: 1px solid #e8edf4;

        display: flex;
        justify-content: space-between;
        align-items: center;

        padding: 12px 30px;
        gap: 20px;

        position: relative;
        z-index: 10;
    }

    /* ==============================
       PAGE TITLE
    ============================== */

    .admin-page-title {
        min-width: 0;
    }

    .admin-page-title h1 {
        color: #1e293b;
        font-size: 20px;
        font-weight: 700;
        margin: 0;
        line-height: 1.4;
    }

    .admin-page-title p {
        color: #94a3b8;
        font-size: 12px;
        margin: 4px 0 0;
        line-height: 1.5;
    }

    /* ==============================
       ADMIN PROFILE
    ============================== */

    .admin-topbar-profile {
        display: flex;
        align-items: center;
        gap: 11px;
        flex-shrink: 0;
    }

    .admin-profile-avatar {
        width: 42px;
        height: 42px;
        min-width: 42px;

        display: flex;
        align-items: center;
        justify-content: center;

        color: #0d6efd;
        background: #eaf2ff;

        border: 1px solid #dbeafe;
        border-radius: 50%;

        font-size: 17px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .admin-profile-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .admin-profile-info strong {
        color: #1e293b;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.3;
    }

    .admin-profile-info span {
        display: flex;
        align-items: center;
        gap: 5px;

        color: #64748b;
        font-size: 11px;
    }

    .admin-profile-info span i {
        color: #0d6efd;
        font-size: 12px;
    }

    /* ==============================
       RESPONSIVE
    ============================== */

    @media (max-width: 750px) {

        .admin-topbar {
            min-height: 68px;
            padding: 10px 18px;
            gap: 10px;
        }

        .admin-page-title h1 {
            font-size: 17px;
        }

        .admin-page-title p {
            font-size: 11px;
        }

        .admin-profile-avatar {
            width: 38px;
            height: 38px;
            min-width: 38px;
            font-size: 15px;
        }

        .admin-profile-info strong {
            font-size: 12px;
        }

    }

    @media (max-width: 480px) {

        .admin-topbar {
            padding: 10px 13px;
        }

        .admin-profile-info {
            display: none;
        }

        .admin-page-title h1 {
            font-size: 16px;
        }

        .admin-page-title p {
            font-size: 10px;
        }

    }
</style>
