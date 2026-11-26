@extends('layouts.appadmin')

@section('page-title', 'Detail User')

@section('content')

<style>
    .detail-user-page {
        padding: 10px 0 30px;
    }

    .detail-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .detail-heading h3 {
        color: #172554;
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .detail-heading p {
        color: #64748b;
        margin: 0;
        font-size: 14px;
    }

    .detail-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(15, 23, 42, .04);
    }

    .detail-card-header {
        padding: 22px 25px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }

    .detail-card-header h5 {
        color: #172554;
        font-weight: 800;
        margin: 0;
    }

    .detail-card-body {
        padding: 25px;
    }

    .user-avatar {
        width: 75px;
        height: 75px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #dbeafe;
        color: #1d4ed8;
        font-size: 30px;
        font-weight: 800;
        margin-bottom: 12px;
    }

    .user-name {
        color: #172554;
        font-size: 21px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .user-username {
        color: #64748b;
        font-size: 14px;
    }

    .detail-divider {
        border: 0;
        border-top: 1px solid #e2e8f0;
        margin: 25px 0;
    }

    .detail-item {
        margin-bottom: 22px;
    }

    .detail-label {
        display: block;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 7px;
    }

    .detail-value {
        color: #1e293b;
        font-size: 15px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .badge-role,
    .badge-status {
        display: inline-block;
        padding: 7px 13px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .role-admin {
        color: #1d4ed8;
        background: #dbeafe;
    }

    .role-petugas {
        color: #7c3aed;
        background: #ede9fe;
    }

    .status-aktif {
        color: #15803d;
        background: #dcfce7;
    }

    .status-nonaktif {
        color: #b91c1c;
        background: #fee2e2;
    }

    .detail-actions {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 25px;
    }

    .btn-detail {
        padding: 10px 18px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        border: none;
    }

    .btn-back {
        color: #475569;
        background: #f1f5f9;
    }

    .btn-back:hover {
        color: #1e293b;
        background: #e2e8f0;
    }

    .btn-edit {
        color: #fff;
        background: #2563eb;
    }

    .btn-edit:hover {
        color: #fff;
        background: #1d4ed8;
    }

    @media (max-width: 576px) {
        .detail-card-body {
            padding: 18px;
        }

        .detail-heading h3 {
            font-size: 21px;
        }

        .detail-actions {
            justify-content: stretch;
        }

        .detail-actions a {
            flex: 1;
            justify-content: center;
        }
    }
</style>

<div class="detail-user-page">

    {{-- HEADER --}}
    <div class="detail-heading">
        <div>
            <h3>Detail User</h3>
            <p>Informasi lengkap akun Administrator dan Petugas.</p>
        </div>

        <a href="{{ route('admin.user.index') }}" class="btn-detail btn-back">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- DETAIL CARD --}}
    <div class="detail-card">

        <div class="detail-card-header">
            <h5>
                <i class="bi bi-person-vcard me-2"></i>
                Informasi Akun User
            </h5>
        </div>

        <div class="detail-card-body">

            {{-- PROFIL --}}
            <div class="text-center">
                <div class="user-avatar mx-auto">
                    {{ strtoupper(substr($user->nama, 0, 1)) }}
                </div>

                <div class="user-name">
                    {{ $user->nama }}
                </div>

                <div class="user-username">
                    <i class="bi bi-person me-1"></i>
                    {{ '@' . $user->username }}
                </div>
            </div>

            <hr class="detail-divider">

            {{-- INFORMASI --}}
            <div class="row">

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">ID User</span>
                        <div class="detail-value">
                            #{{ $user->iduser }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Nama Lengkap</span>
                        <div class="detail-value">
                            {{ $user->nama }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Username</span>
                        <div class="detail-value">
                            {{ $user->username }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Role / Hak Akses</span>
                        <div class="detail-value">
                            @if ($user->role === 'admin')
                            <span class="badge-role role-admin">
                                <i class="bi bi-shield-lock me-1"></i>
                                Administrator
                            </span>
                            @else
                            <span class="badge-role role-petugas">
                                <i class="bi bi-person-badge me-1"></i>
                                Petugas
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Status Akun</span>
                        <div class="detail-value">
                            @if ($user->aktif)
                            <span class="badge-status status-aktif">
                                <i class="bi bi-check-circle me-1"></i>
                                Aktif
                            </span>
                            @else
                            <span class="badge-status status-nonaktif">
                                <i class="bi bi-x-circle me-1"></i>
                                Nonaktif
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Tanggal Dibuat</span>
                        <div class="detail-value">
                            {{ $user->created_at?->format('d-m-Y H:i') ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Terakhir Diperbarui</span>
                        <div class="detail-value">
                            {{ $user->updated_at?->format('d-m-Y H:i') ?? '-' }}
                        </div>
                    </div>
                </div>

            </div>

            <hr class="detail-divider">

            {{-- ACTION --}}
            <div class="detail-actions">

                <a href="{{ route('admin.user.index') }}" class="btn-detail btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Data User
                </a>

                <a href="{{ route('admin.user.edit', $user->iduser) }}"
                    class="btn-detail btn-edit">
                    <i class="bi bi-pencil-square"></i>
                    Edit User
                </a>

            </div>

        </div>
    </div>

</div>

@endsection