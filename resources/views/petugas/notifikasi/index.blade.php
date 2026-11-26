@extends('layouts.appetugas')

@section('page-title', 'Notifikasi')

@section('content')

<style>
    .notification-page {
        padding: 10px 0 35px;
    }

    .notification-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .notification-heading h3 {
        color: #172554;
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .notification-heading p {
        color: #64748b;
        margin: 0;
        font-size: 14px;
    }

    .notification-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 25px;
    }

    .notification-stat {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .04);
    }

    .notification-stat span {
        display: block;
        color: #64748b;
        font-size: 13px;
        margin-bottom: 9px;
    }

    .notification-stat strong {
        display: block;
        font-size: 27px;
        font-weight: 800;
        color: #172554;
    }

    .notification-toolbar {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px 14px 0 0;
        padding: 18px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .notification-toolbar h4 {
        color: #172554;
        font-size: 16px;
        font-weight: 800;
        margin: 0;
    }

    .btn-read-all {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        border-radius: 8px;
        background: #eff6ff;
        color: #1d4ed8;
        padding: 10px 15px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
    }

    .btn-read-all:hover {
        background: #dbeafe;
        color: #1e40af;
    }

    .notification-list {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-top: none;
        border-radius: 0 0 14px 14px;
        overflow: hidden;
    }

    .notification-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 20px;
        border-bottom: 1px solid #f1f5f9;
        transition: .2s;
    }

    .notification-item:last-child {
        border-bottom: none;
    }

    .notification-item:hover {
        background: #f8fafc;
    }

    .notification-item.unread {
        background: #f8fbff;
    }

    .notification-icon {
        width: 44px;
        height: 44px;
        min-width: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 19px;
        font-weight: 800;
    }

    .notification-content {
        flex: 1;
        min-width: 0;
    }

    .notification-title {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 9px;
        margin-bottom: 7px;
    }

    .notification-title h5 {
        font-size: 15px;
        color: #1e293b;
        font-weight: 800;
        margin: 0;
    }

    .notification-message {
        color: #64748b;
        font-size: 13px;
        line-height: 1.7;
        margin: 0 0 10px;
        overflow-wrap: anywhere;
    }

    .notification-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        color: #94a3b8;
        font-size: 11px;
    }

    .notification-meta strong {
        color: #475569;
        font-weight: 700;
    }

    .status-unread,
    .status-read {
        display: inline-flex;
        align-items: center;
        border-radius: 20px;
        padding: 5px 10px;
        font-size: 10px;
        font-weight: 800;
    }

    .status-unread {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-read {
        background: #f1f5f9;
        color: #64748b;
    }

    .notification-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        margin-left: 10px;
    }

    .btn-notification {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        border-radius: 7px;
        padding: 8px 11px;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
        white-space: nowrap;
    }

    .btn-detail {
        background: #eff6ff;
        color: #1d4ed8;
    }

    .btn-detail:hover {
        background: #dbeafe;
        color: #1e40af;
    }

    .btn-read {
        background: #ecfdf5;
        color: #047857;
    }

    .btn-read:hover {
        background: #d1fae5;
        color: #065f46;
    }

    .btn-delete {
        background: #fef2f2;
        color: #dc2626;
    }

    .btn-delete:hover {
        background: #fee2e2;
        color: #b91c1c;
    }

    .notification-empty {
        text-align: center;
        padding: 55px 20px;
    }

    .notification-empty .empty-icon {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 27px;
        margin: 0 auto 15px;
    }

    .notification-empty h5 {
        color: #1e293b;
        font-weight: 800;
        font-size: 16px;
        margin-bottom: 7px;
    }

    .notification-empty p {
        color: #94a3b8;
        font-size: 13px;
        margin: 0;
    }

    .notification-pagination {
        padding: 17px 20px;
        border-top: 1px solid #f1f5f9;
    }

    @media(max-width: 768px) {
        .notification-stats {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .notification-item {
            flex-wrap: wrap;
        }

        .notification-actions {
            width: 100%;
            margin-left: 59px;
        }
    }

    @media(max-width: 480px) {
        .notification-heading h3 {
            font-size: 21px;
        }

        .notification-actions {
            margin-left: 0;
        }

        .notification-toolbar {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>

<div class="notification-page">

    {{-- JUDUL HALAMAN --}}
    <div class="notification-heading">
        <div>
            <h3>Notifikasi Petugas</h3>
            <p>Informasi dan pemberitahuan terkait pengaduan yang ditugaskan kepada Anda.</p>
        </div>
    </div>


    {{-- PESAN SUKSES --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif


    {{-- PESAN ERROR --}}
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif


    {{-- STATISTIK NOTIFIKASI --}}
    <div class="notification-stats">

        <div class="notification-stat">
            <span>Total Notifikasi</span>
            <strong>{{ number_format($totalNotifikasi) }}</strong>
        </div>

        <div class="notification-stat">
            <span>Belum Dibaca</span>
            <strong style="color:#2563eb;">
                {{ number_format($belumDibaca) }}
            </strong>
        </div>

        <div class="notification-stat">
            <span>Sudah Dibaca</span>
            <strong style="color:#059669;">
                {{ number_format($sudahDibaca) }}
            </strong>
        </div>

    </div>


    {{-- DAFTAR NOTIFIKASI --}}
    <div class="notification-toolbar">

        <h4>Daftar Pemberitahuan</h4>

        @if($belumDibaca > 0)
        <form action="{{ route('petugas.notifikasi.readAll') }}"
            method="POST"
            onsubmit="return confirm('Tandai semua notifikasi sebagai sudah dibaca?')">

            @csrf
            @method('PATCH')

            <button type="submit" class="btn-read-all">
                Tandai Semua Dibaca
            </button>
        </form>
        @endif

    </div>


    <div class="notification-list">

        @forelse($data as $notifikasi)

        <div class="notification-item {{ !$notifikasi->dibaca ? 'unread' : '' }}">

            {{-- IKON --}}
            <div class="notification-icon">
                &#128276;
            </div>


            {{-- INFORMASI NOTIFIKASI --}}
            <div class="notification-content">

                <div class="notification-title">

                    <h5>{{ $notifikasi->judul }}</h5>

                    @if(!$notifikasi->dibaca)
                    <span class="status-unread">Belum Dibaca</span>
                    @else
                    <span class="status-read">Sudah Dibaca</span>
                    @endif

                </div>


                <p class="notification-message">
                    {{ $notifikasi->pesan }}
                </p>


                <div class="notification-meta">

                    <span>
                        Tiket:
                        <strong>
                            {{ $notifikasi->pengaduan->nomor_tiket ?? '-' }}
                        </strong>
                    </span>

                    <span>
                        Pengadu:
                        <strong>
                            {{ $notifikasi->pengadu->nama ?? '-' }}
                        </strong>
                    </span>

                    <span>
                        {{ $notifikasi->created_at
                                ? $notifikasi->created_at->format('d-m-Y H:i')
                                : '-' }}
                    </span>

                </div>

            </div>


            {{-- TOMBOL AKSI --}}
            <div class="notification-actions">

                <a href="{{ route('petugas.notifikasi.show', $notifikasi->idnotifikasi) }}"
                    class="btn-notification btn-detail">
                    Detail
                </a>


                @if(!$notifikasi->dibaca)

                <form action="{{ route('petugas.notifikasi.read', $notifikasi->idnotifikasi) }}"
                    method="POST">

                    @csrf
                    @method('PATCH')

                    <button type="submit" class="btn-notification btn-read">
                        Tandai Dibaca
                    </button>

                </form>

                @endif


                <form action="{{ route('petugas.notifikasi.destroy', $notifikasi->idnotifikasi) }}"
                    method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus notifikasi ini?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn-notification btn-delete">
                        Hapus
                    </button>

                </form>

            </div>

        </div>

        @empty

        <div class="notification-empty">

            <div class="empty-icon">
                &#128276;
            </div>

            <h5>Belum Ada Notifikasi</h5>

            <p>
                Saat ini belum ada pemberitahuan untuk pengaduan yang ditugaskan kepada Anda.
            </p>

        </div>

        @endforelse


        {{-- PAGINATION --}}
        @if($data->hasPages())
        <div class="notification-pagination">
            {{ $data->links() }}
        </div>
        @endif

    </div>

</div>

@endsection