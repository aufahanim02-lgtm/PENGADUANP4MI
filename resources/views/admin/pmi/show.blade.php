@extends('layouts.appadmin')

@section('page-title', 'Detail PMI')

@section('content')

<style>
    .pmi-detail-page {
        padding: 8px 0 30px;
        color: #334155;
    }

    .detail-heading {
        margin-bottom: 23px;
    }

    .detail-heading h3 {
        color: #172554;
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .detail-heading p {
        color: #64748b;
        font-size: 14px;
        margin: 0;
    }

    .detail-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 20px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .035);
    }

    .detail-card-header {
        padding: 19px 23px;
        border-bottom: 1px solid #e2e8f0;
        background: #f8fafc;
    }

    .detail-card-header h5 {
        color: #172554;
        font-size: 15px;
        font-weight: 800;
        margin: 0;
    }

    .detail-card-body {
        padding: 23px;
    }

    .profile-area {
        display: flex;
        align-items: center;
        gap: 17px;
    }

    .profile-avatar {
        width: 65px;
        height: 65px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eff6ff;
        color: #2563eb;
        border-radius: 16px;
        font-size: 27px;
        font-weight: 800;
    }

    .profile-name {
        color: #172554;
        font-size: 20px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .profile-nik {
        color: #64748b;
        font-size: 13px;
    }

    .detail-item {
        margin-bottom: 21px;
    }

    .detail-item:last-child {
        margin-bottom: 0;
    }

    .detail-label {
        display: block;
        color: #94a3b8;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .4px;
        margin-bottom: 7px;
    }

    .detail-value {
        color: #334155;
        font-size: 14px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .detail-divider {
        border-top: 1px solid #f1f5f9;
        margin: 21px 0;
    }

    .badge-gender {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 20px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 12px;
        font-weight: 700;
    }

    .badge-status {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 20px;
        background: #dcfce7;
        color: #15803d;
        font-size: 12px;
        font-weight: 700;
    }

    .pengadu-box {
        padding: 16px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
    }

    .pengadu-box strong {
        display: block;
        color: #172554;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .pengadu-box small {
        color: #64748b;
        font-size: 12px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 17px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        background: #fff;
        color: #475569;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s ease;
    }

    .btn-back:hover {
        background: #f1f5f9;
        color: #172554;
    }

    @media (max-width: 768px) {
        .detail-heading h3 {
            font-size: 22px;
        }

        .detail-card-body {
            padding: 18px;
        }
    }
</style>

<div class="pmi-detail-page">

    {{-- HEADER --}}
    <div class="detail-heading">
        <h3>Detail Data PMI</h3>
        <p>Informasi lengkap Pekerja Migran Indonesia.</p>
    </div>

    {{-- PROFIL PMI --}}
    <div class="detail-card">

        <div class="detail-card-body">
            <div class="profile-area">

                <div class="profile-avatar">
                    {{ strtoupper(substr($pmi->nama ?? 'P', 0, 1)) }}
                </div>

                <div>
                    <div class="profile-name">
                        {{ $pmi->nama }}
                    </div>

                    <div class="profile-nik">
                        NIK: {{ $pmi->nik ?: '-' }}
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- IDENTITAS PMI --}}
    <div class="detail-card">

        <div class="detail-card-header">
            <h5>
                <i class="fas fa-user me-2 text-primary"></i>
                Identitas PMI
            </h5>
        </div>

        <div class="detail-card-body">

            <div class="row">

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Nama Lengkap</span>
                        <div class="detail-value">{{ $pmi->nama ?: '-' }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">NIK</span>
                        <div class="detail-value">{{ $pmi->nik ?: '-' }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Jenis Kelamin</span>
                        <div class="detail-value">
                            @if($pmi->jeniskelamin)
                                <span class="badge-gender">
                                    {{ $pmi->jeniskelamin }}
                                </span>
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Tanggal Lahir</span>
                        <div class="detail-value">
                            {{ $pmi->tanggallahir
                                ? \Carbon\Carbon::parse($pmi->tanggallahir)->format('d-m-Y')
                                : '-' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Nomor HP</span>
                        <div class="detail-value">{{ $pmi->nohp ?: '-' }}</div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    {{-- INFORMASI PEKERJAAN --}}
    <div class="detail-card">

        <div class="detail-card-header">
            <h5>
                <i class="fas fa-briefcase me-2 text-primary"></i>
                Informasi Pekerjaan dan Negara Tujuan
            </h5>
        </div>

        <div class="detail-card-body">

            <div class="row">

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Negara Tujuan</span>
                        <div class="detail-value">{{ $pmi->negara ?: '-' }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Perusahaan</span>
                        <div class="detail-value">{{ $pmi->perusahaan ?: '-' }}</div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="detail-item">
                        <span class="detail-label">Alamat Tempat Kerja</span>
                        <div class="detail-value">
                            {{ $pmi->alamatkerja ?: '-' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Status PMI</span>
                        <div class="detail-value">
                            @if($pmi->statuspmi)
                                <span class="badge-status">
                                    {{ $pmi->statuspmi }}
                                </span>
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    {{-- AKUN PENGADU --}}
    <div class="detail-card">

        <div class="detail-card-header">
            <h5>
                <i class="fas fa-user-circle me-2 text-primary"></i>
                Informasi Akun Pengadu
            </h5>
        </div>

        <div class="detail-card-body">

            @if($pmi->pengadu)

                <div class="pengadu-box">
                    <strong>
                        <i class="fas fa-user me-2"></i>
                        {{ $pmi->pengadu->nama }}
                    </strong>

                    <small>
                        Username: {{ $pmi->pengadu->username ?: '-' }}
                    </small>
                </div>

            @else

                <div class="text-muted" style="font-size: 13px;">
                    Data akun Pengadu tidak tersedia.
                </div>

            @endif

        </div>
    </div>

    {{-- TOMBOL KEMBALI --}}
    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.pmi.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Data PMI
        </a>
    </div>

</div>

@endsection