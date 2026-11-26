@extends('layouts.appetugas')

@section('page-title', 'Detail Notifikasi')

@section('content')

<style>
    .detail-notification {
        padding: 10px 0 35px;
    }

    .notification-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 22px;
    }

    .notification-header h3 {
        color: #172554;
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .notification-header p {
        color: #64748b;
        font-size: 13px;
        margin: 0;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 16px;
        border-radius: 8px;
        background: #f1f5f9;
        color: #334155;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        transition: .2s;
    }

    .btn-back:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    .notification-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(15, 23, 42, .04);
    }

    .notification-card-header {
        padding: 25px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .notification-main-icon {
        width: 55px;
        height: 55px;
        min-width: 55px;
        border-radius: 14px;
        background: #dbeafe;
        color: #1d4ed8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
    }

    .notification-card-header h4 {
        font-size: 19px;
        color: #172554;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .notification-card-body {
        padding: 25px;
    }

    .notification-status {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 800;
    }

    .status-read {
        color: #047857;
        background: #d1fae5;
    }

    .status-unread {
        color: #1d4ed8;
        background: #dbeafe;
    }

    .notification-message-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
    }

    .notification-message-box h5 {
        color: #334155;
        font-size: 14px;
        font-weight: 800;
        margin-bottom: 12px;
    }

    .notification-message-box p {
        color: #475569;
        font-size: 14px;
        line-height: 1.8;
        margin: 0;
        white-space: pre-line;
        overflow-wrap: anywhere;
    }

    .notification-section-title {
        color: #172554;
        font-size: 15px;
        font-weight: 800;
        padding-bottom: 13px;
        margin-bottom: 18px;
        border-bottom: 1px solid #e2e8f0;
    }

    .notification-information {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .information-item {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 15px;
    }

    .information-item span {
        display: block;
        color: #94a3b8;
        font-size: 11px;
        margin-bottom: 7px;
    }

    .information-item strong {
        display: block;
        color: #334155;
        font-size: 13px;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .notification-footer {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 20px 25px;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border: none;
        border-radius: 8px;
        padding: 11px 16px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
    }

    .btn-primary-custom {
        background: #2563eb;
        color: #fff;
    }

    .btn-primary-custom:hover {
        background: #1d4ed8;
        color: #fff;
    }

    .btn-danger-custom {
        background: #fee2e2;
        color: #b91c1c;
    }

    .btn-danger-custom:hover {
        background: #fecaca;
        color: #991b1b;
    }

    @media(max-width: 600px) {
        .notification-information {
            grid-template-columns: 1fr;
        }

        .notification-card-header,
        .notification-card-body {
            padding: 18px;
        }

        .notification-footer {
            padding: 18px;
        }

        .notification-header h3 {
            font-size: 21px;
        }
    }
</style>

<div class="detail-notification">

    {{-- HEADER --}}
    <div class="notification-header">
        <div>
            <h3>Detail Notifikasi</h3>
            <p>Informasi lengkap pemberitahuan pengaduan.</p>
        </div>

        <a href="{{ route('petugas.notifikasi.index') }}" class="btn-back">
            &larr; Kembali
        </a>
    </div>


    {{-- NOTIFICATION CARD --}}
    <div class="notification-card">

        {{-- JUDUL NOTIFIKASI --}}
        <div class="notification-card-header">

            <div class="notification-main-icon">
                &#128276;
            </div>

            <div>
                <h4>{{ $notifikasi->judul }}</h4>

                @if($notifikasi->dibaca)
                <span class="notification-status status-read">
                    Sudah Dibaca
                </span>
                @else
                <span class="notification-status status-unread">
                    Belum Dibaca
                </span>
                @endif
            </div>

        </div>


        <div class="notification-card-body">

            {{-- ISI PESAN --}}
            <div class="notification-message-box">
                <h5>Isi Pemberitahuan</h5>

                <p>{{ $notifikasi->pesan }}</p>
            </div>


            {{-- INFORMASI PENGADUAN --}}
            <h5 class="notification-section-title">
                Informasi Pengaduan
            </h5>

            <div class="notification-information">

                <div class="information-item">
                    <span>Nomor Tiket</span>
                    <strong>
                        {{ $notifikasi->pengaduan->nomor_tiket ?? '-' }}
                    </strong>
                </div>

                <div class="information-item">
                    <span>Judul Pengaduan</span>
                    <strong>
                        {{ $notifikasi->pengaduan->judul ?? '-' }}
                    </strong>
                </div>

                <div class="information-item">
                    <span>Nama Pengadu</span>
                    <strong>
                        {{ $notifikasi->pengadu->nama ?? '-' }}
                    </strong>
                </div>

                <div class="information-item">
                    <span>Status Pengaduan</span>
                    <strong>
                        {{ $notifikasi->pengaduan->status ?? '-' }}
                    </strong>
                </div>

            </div>


            {{-- WAKTU NOTIFIKASI --}}
            <h5 class="notification-section-title" style="margin-top:25px;">
                Informasi Notifikasi
            </h5>

            <div class="notification-information">

                <div class="information-item">
                    <span>Tanggal Dibuat</span>
                    <strong>
                        {{ $notifikasi->created_at
                            ? $notifikasi->created_at->format('d F Y, H:i')
                            : '-' }}
                    </strong>
                </div>

                <div class="information-item">
                    <span>Tanggal Dibaca</span>
                    <strong>
                        {{ $notifikasi->dibaca_pada
                            ? $notifikasi->dibaca_pada->format('d F Y, H:i')
                            : 'Belum dibaca' }}
                    </strong>
                </div>

            </div>

        </div>


        {{-- TOMBOL AKSI --}}
        <div class="notification-footer">

            @if($notifikasi->idpengaduan)
            <a href="{{ route('petugas.pengaduan.show', $notifikasi->idpengaduan) }}"
                class="btn-action btn-primary-custom">
                Lihat Pengaduan
            </a>
            @endif

            <a href="{{ route('petugas.notifikasi.index') }}"
                class="btn-action btn-back">
                Kembali ke Daftar
            </a>

            <form action="{{ route('petugas.notifikasi.destroy', $notifikasi->idnotifikasi) }}"
                method="POST"
                onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?')">

                @csrf
                @method('DELETE')

                <button type="submit" class="btn-action btn-danger-custom">
                    Hapus Notifikasi
                </button>

            </form>

        </div>

    </div>

</div>

@endsection