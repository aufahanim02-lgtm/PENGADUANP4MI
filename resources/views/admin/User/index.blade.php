@extends('layouts.appadmin')

@section('page-title', 'Data User')

@section('content')

<style>
    .user-page {
        padding: 10px 0 30px;
        color: #1e293b;
    }

    .user-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 25px;
    }

    .user-heading h3 {
        color: #172554;
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .user-heading p {
        color: #64748b;
        font-size: 14px;
        margin: 0;
    }

    .btn-add-user {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #2563eb;
        color: white;
        padding: 11px 18px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        border: none;
        transition: .2s;
    }

    .btn-add-user:hover {
        background: #1d4ed8;
        color: white;
        transform: translateY(-2px);
    }

    .user-stat-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 15px;
        margin-bottom: 25px;
    }

    .user-stat-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 13px;
        padding: 19px;
        display: flex;
        align-items: center;
        gap: 13px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .035);
    }

    .user-stat-icon {
        width: 45px;
        height: 45px;
        min-width: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        font-size: 21px;
    }

    .stat-blue {
        background: #dbeafe;
        color: #2563eb;
    }

    .stat-purple {
        background: #ede9fe;
        color: #7c3aed;
    }

    .stat-orange {
        background: #ffedd5;
        color: #ea580c;
    }

    .stat-green {
        background: #dcfce7;
        color: #16a34a;
    }

    .stat-red {
        background: #fee2e2;
        color: #dc2626;
    }

    .user-stat-info small {
        display: block;
        color: #64748b;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .user-stat-info h4 {
        color: #172554;
        font-size: 23px;
        font-weight: 800;
        margin: 0;
    }

    .user-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 13px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .035);
        overflow: hidden;
    }

    .user-card-header {
        padding: 20px 22px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .user-card-header h5 {
        color: #172554;
        font-size: 16px;
        font-weight: 800;
        margin: 0 0 5px;
    }

    .user-card-header p {
        color: #64748b;
        font-size: 12px;
        margin: 0;
    }

    .user-filter {
        padding: 18px 22px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }

    .user-filter-form {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr auto auto;
        gap: 10px;
        align-items: end;
    }

    .user-filter label {
        display: block;
        color: #475569;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .user-filter .form-control,
    .user-filter .form-select {
        min-height: 40px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 13px;
        box-shadow: none;
    }

    .user-filter .form-control:focus,
    .user-filter .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .1);
    }

    .btn-filter {
        min-height: 40px;
        background: #2563eb;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0 17px;
        font-size: 13px;
        font-weight: 700;
    }

    .btn-filter:hover {
        background: #1d4ed8;
    }

    .btn-reset {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 15px;
        background: white;
        border: 1px solid #cbd5e1;
        color: #475569;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
    }

    .btn-reset:hover {
        background: #f1f5f9;
        color: #1e293b;
    }

    .user-table-wrapper {
        overflow-x: auto;
    }

    .user-table {
        width: 100%;
        min-width: 850px;
        border-collapse: collapse;
    }

    .user-table thead {
        background: #eff6ff;
    }

    .user-table th {
        color: #1e40af;
        font-size: 12px;
        font-weight: 800;
        padding: 15px 16px;
        white-space: nowrap;
        border-bottom: 1px solid #dbeafe;
    }

    .user-table td {
        color: #475569;
        font-size: 13px;
        padding: 15px 16px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .user-table tbody tr:hover {
        background: #f8fafc;
    }

    .user-number {
        color: #94a3b8;
        font-weight: 700;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 11px;
        min-width: 180px;
    }

    .user-avatar {
        width: 38px;
        height: 38px;
        min-width: 38px;
        border-radius: 50%;
        background: #dbeafe;
        color: #1d4ed8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        font-weight: 800;
    }

    .user-name {
        color: #1e293b;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .user-username {
        color: #94a3b8;
        font-size: 11px;
    }

    .role-badge,
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .role-admin {
        background: #ede9fe;
        color: #6d28d9;
    }

    .role-petugas {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-aktif {
        background: #dcfce7;
        color: #15803d;
    }

    .status-nonaktif {
        background: #fee2e2;
        color: #b91c1c;
    }

    .user-actions {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .btn-action {
        width: 31px;
        height: 31px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 13px;
        transition: .2s;
    }

    .btn-detail {
        background: #dbeafe;
        color: #2563eb;
    }

    .btn-edit {
        background: #fef3c7;
        color: #b45309;
    }

    .btn-delete {
        background: #fee2e2;
        color: #dc2626;
    }

    .btn-action:hover {
        filter: brightness(.95);
        transform: translateY(-1px);
    }

    .user-empty {
        text-align: center;
        padding: 45px 15px !important;
        color: #94a3b8 !important;
    }

    .user-empty-icon {
        font-size: 35px;
        margin-bottom: 10px;
    }

    .user-card-footer {
        padding: 16px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .user-card-footer p {
        color: #64748b;
        font-size: 12px;
        margin: 0;
    }

    .user-card-footer .pagination {
        margin: 0;
    }

    .user-card-footer .page-link {
        color: #2563eb;
        border-radius: 6px;
        margin: 0 2px;
        font-size: 12px;
    }

    .user-card-footer .active .page-link {
        background: #2563eb;
        border-color: #2563eb;
        color: white;
    }

    .user-alert {
        border-radius: 9px;
        padding: 13px 16px;
        font-size: 13px;
        margin-bottom: 18px;
    }

    @media (max-width: 1100px) {
        .user-stat-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 768px) {
        .user-stat-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .user-filter-form {
            grid-template-columns: 1fr 1fr;
        }

        .user-filter-search {
            grid-column: 1 / -1;
        }

        .user-heading h3 {
            font-size: 21px;
        }
    }

    @media (max-width: 480px) {
        .user-stat-grid {
            grid-template-columns: 1fr;
        }

        .user-filter-form {
            grid-template-columns: 1fr;
        }

        .user-filter-search {
            grid-column: auto;
        }

        .user-card-header,
        .user-filter,
        .user-card-footer {
            padding-left: 15px;
            padding-right: 15px;
        }
    }
</style>

<div class="user-page">

    {{-- JUDUL HALAMAN --}}
    <div class="user-heading">
        <div>
            <h3>Data User</h3>
            <p>Kelola akun Administrator dan Petugas P4MI.</p>
        </div>

        <a href="{{ route('admin.user.create') }}" class="btn-add-user">
            <span>＋</span>
            Tambah User
        </a>
    </div>


    {{-- PESAN BERHASIL / ERROR --}}
    @if (session('success'))
    <div class="alert alert-success user-alert">
        ✓ {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger user-alert">
        ⚠ {{ session('error') }}
    </div>
    @endif


    {{-- STATISTIK USER --}}
    <div class="user-stat-grid">

        <div class="user-stat-card">
            <div class="user-stat-icon stat-blue">♙</div>
            <div class="user-stat-info">
                <small>Total User</small>
                <h4>{{ $totalUser }}</h4>
            </div>
        </div>

        <div class="user-stat-card">
            <div class="user-stat-icon stat-purple">♔</div>
            <div class="user-stat-info">
                <small>Administrator</small>
                <h4>{{ $totalAdmin }}</h4>
            </div>
        </div>

        <div class="user-stat-card">
            <div class="user-stat-icon stat-orange">♧</div>
            <div class="user-stat-info">
                <small>Petugas</small>
                <h4>{{ $totalPetugas }}</h4>
            </div>
        </div>

        <div class="user-stat-card">
            <div class="user-stat-icon stat-green">✓</div>
            <div class="user-stat-info">
                <small>Akun Aktif</small>
                <h4>{{ $totalAktif }}</h4>
            </div>
        </div>

        <div class="user-stat-card">
            <div class="user-stat-icon stat-red">⊘</div>
            <div class="user-stat-info">
                <small>Akun Nonaktif</small>
                <h4>{{ $totalNonaktif }}</h4>
            </div>
        </div>

    </div>


    {{-- TABEL DATA USER --}}
    <div class="user-card">

        <div class="user-card-header">
            <div>
                <h5>Daftar User</h5>
                <p>Informasi seluruh akun Admin dan Petugas.</p>
            </div>
        </div>


        {{-- FILTER DAN PENCARIAN --}}
        <div class="user-filter">

            <form action="{{ route('admin.user.index') }}"
                method="GET"
                class="user-filter-form">

                <div class="user-filter-search">
                    <label for="cari">Cari User</label>
                    <input
                        type="text"
                        name="cari"
                        id="cari"
                        class="form-control"
                        placeholder="Cari nama atau username..."
                        value="{{ request('cari') }}">
                </div>

                <div>
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-select">
                        <option value="">Semua Role</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>
                        <option value="petugas" {{ request('role') == 'petugas' ? 'selected' : '' }}>
                            Petugas
                        </option>
                    </select>
                </div>

                <div>
                    <label for="aktif">Status</label>
                    <select name="aktif" id="aktif" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="1" {{ request('aktif') === '1' ? 'selected' : '' }}>
                            Aktif
                        </option>
                        <option value="0" {{ request('aktif') === '0' ? 'selected' : '' }}>
                            Nonaktif
                        </option>
                    </select>
                </div>

                <button type="submit" class="btn-filter">
                    Cari
                </button>

                <a href="{{ route('admin.user.index') }}" class="btn-reset">
                    Reset
                </a>

            </form>

        </div>


        {{-- TABEL --}}
        <div class="user-table-wrapper">

            <table class="user-table">

                <thead>
                    <tr>
                        <th width="55">No.</th>
                        <th>Nama User</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status Akun</th>
                        <th width="130">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($data as $index => $user)

                    <tr>

                        <td class="user-number">
                            {{ $data->firstItem() + $index }}
                        </td>

                        <td>
                            <div class="user-profile">

                                <div class="user-avatar">
                                    {{ strtoupper(substr($user->nama, 0, 1)) }}
                                </div>

                                <div>
                                    <div class="user-name">
                                        {{ $user->nama }}
                                    </div>
                                    <div class="user-username">
                                        ID User: {{ $user->iduser }}
                                    </div>
                                </div>

                            </div>
                        </td>

                        <td>
                            {{ $user->username }}
                        </td>

                        <td>
                            @if ($user->role === 'admin')
                            <span class="role-badge role-admin">
                                Administrator
                            </span>
                            @else
                            <span class="role-badge role-petugas">
                                Petugas
                            </span>
                            @endif
                        </td>

                        <td>
                            @if ($user->aktif)
                            <span class="status-badge status-aktif">
                                ● Aktif
                            </span>
                            @else
                            <span class="status-badge status-nonaktif">
                                ● Nonaktif
                            </span>
                            @endif
                        </td>

                        <td>
                            <div class="user-actions">

                                {{-- DETAIL --}}
                                <a
                                    href="{{ route('admin.user.show', $user->iduser) }}"
                                    class="btn-action btn-detail"
                                    title="Detail User">
                                    <i class="bi bi-eye"></i>
                                </a>

                                {{-- EDIT --}}
                                <a
                                    href="{{ route('admin.user.edit', $user->iduser) }}"
                                    class="btn-action btn-edit"
                                    title="Edit User">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                {{-- NONAKTIFKAN --}}
                                @if (auth('user')->id() != $user->iduser && $user->aktif)

                                <form
                                    action="{{ route('admin.user.destroy', $user->iduser) }}"
                                    method="POST"
                                    onsubmit="return confirm('Apakah kamu yakin ingin menonaktifkan akun {{ $user->nama }}?')">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-action btn-delete"
                                        title="Nonaktifkan User">
                                        <i class="bi bi-person-x"></i>
                                    </button>
                                </form>

                                @elseif (!$user->aktif)

                                <span
                                    class="btn-action btn-delete"
                                    title="Akun sudah nonaktif"
                                    style="opacity:.45; cursor:not-allowed;">
                                    <i class="bi bi-person-x"></i>
                                </span>

                                @else

                                <span
                                    class="btn-action btn-delete"
                                    title="Tidak dapat menonaktifkan akun sendiri"
                                    style="opacity:.45; cursor:not-allowed;">
                                    <i class="bi bi-lock"></i>
                                </span>

                                @endif

                            </div>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="user-empty">
                            <div class="user-empty-icon">♙</div>
                            <strong>Data User Tidak Ditemukan</strong>
                            <div style="font-size:12px; margin-top:6px;">
                                Belum ada data yang sesuai dengan pencarian.
                            </div>
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- FOOTER DAN PAGINATION --}}
        <div class="user-card-footer">

            <p>
                Menampilkan
                <strong>{{ $data->firstItem() ?? 0 }}</strong>
                sampai
                <strong>{{ $data->lastItem() ?? 0 }}</strong>
                dari
                <strong>{{ $data->total() }}</strong>
                data user
            </p>

            <div>
                {{ $data->links() }}
            </div>

        </div>

    </div>

</div>

@endsection