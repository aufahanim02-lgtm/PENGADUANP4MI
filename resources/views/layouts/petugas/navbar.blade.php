<header class="topbar">

    <div class="page-title">

        <h1>
            @yield('page-title', 'Dashboard')
        </h1>

        <p>
            Panel Petugas Pengaduan P4MI
        </p>

    </div>


    <div class="petugas-profile">

        <div class="profile-avatar">

            {{ strtoupper(
                substr(
                    auth('user')->user()->nama ?? 'P',
                    0,
                    1
                )
            ) }}

        </div>


        <div class="profile-info">

            <strong>
                {{ auth('user')->user()->nama ?? 'Petugas' }}
            </strong>

            <span>
                Petugas
            </span>

        </div>

    </div>

</header>


<style>
    .topbar {
        height: 72px;
        background: white;
        border-bottom: 1px solid #e8ecf3;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 32px;
    }

    .page-title h1 {
        font-size: 20px;
    }

    .page-title p {
        font-size: 12px;
        color: #8a94a6;
        margin-top: 3px;
    }

    .petugas-profile {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .profile-avatar {
        width: 38px;
        height: 38px;
        background: #eaf2ff;
        color: #0d6efd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .profile-info strong {
        display: block;
        font-size: 13px;
    }

    .profile-info span {
        color: #8993a4;
        font-size: 11px;
    }

    @media (max-width: 750px) {

        .topbar {
            padding: 0 18px;
        }

        .profile-info {
            display: none;
        }

        .page-title h1 {
            font-size: 17px;
        }

    }
</style>