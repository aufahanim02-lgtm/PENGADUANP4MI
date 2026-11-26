@extends('layouts.appadmin')

@section('page-title', 'Detail Tindak Lanjut')

@section('content')

<style>
    .detail-page {
        padding: 10px 0 30px;
    }

    .detail-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
        flex-wrap: wrap;
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

    .detail-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s;
    }

    .btn-back {
        background: #f1f5f9;
        color: #475569;
    }

    .btn-back:hover {
        background: #e2e8f0;
        color: #172554;
    }

    .btn-primary-custom {
        background: #1d4ed8;
        color: white;
    }

    .btn-primary-custom:hover {
        background: #1e40af;
        color: white;
    }

    .detail-hero {
        background: linear-gradient(120deg, #172554, #1d4ed8);
        border-radius: 16px;
        padding: 25px;
        color: white;
        margin-bottom: 22px;
        box-shadow: 0 8px 22px rgba(29, 78, 216, .12);
    }

    .hero-label {
        font-size: 12px;
        color: #bfdbfe;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .7px;
        margin-bottom: 8px;
    }

    .hero-ticket {
        font-size: 22px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .hero-title {
        font-size: 14px;
        color: #dbeafe;
        margin: 0;
    }

    .hero-status {
        display: inline-block;
        padding: 8px 14px;
        background: rgba(255, 255, 255, .17);
        border: 1px solid rgba(255, 255, 255, .25);
        border-radius: 30px;
        font-size: 12px;
        font-weight: 800;
        margin-top: 16px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 1.3fr .7fr;
        gap: 20px;
        align-items: start;
    }

    .detail-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        margin-bottom: 20px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(15, 23, 42, .035);
    }

    .detail-card-header {
        padding: 18px 21px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .detail-card-header h5 {
        color: #172554;
        font-size: 15px;
        font-weight: 800;
        margin: 0;
    }

    .detail-card-header i {
        color: #2563eb;
        font-size: 16px;
    }

    .detail-card-body {
        padding: 22px;
    }

    .detail-label {
        color: #94a3b8;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 7px;
    }

    .detail-value {
        color: #334155;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.7;
        overflow-wrap: anywhere;
    }

    .detail-item {
        margin-bottom: 20px;
    }

    .detail-item:last-child {
        margin-bottom: 0;
    }

    .detail-divider {
        border: 0;
        border-top: 1px solid #f1f5f9;
        margin: 19px 0;
    }

    .status-badge {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 800;
    }

    .status-diproses {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-selesai {
        background: #dcfce7;
        color: #15803d;
    }

    .status-ditolak {
        background: #fee2e2;
        color: #b91c1c;
    }

    .status-lain {
        background: #f1f5f9;
        color: #475569;
    }

    .detail-note {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 18px;
        color: #334155;
        font-size: 14px;
        line-height: 1.9;
        white-space: pre-line;
    }

    .detail-info {
        background: #eff6ff;
        border: 1px solid #dbeafe;
        color: #1e40af;
        border-radius: 11px;
        padding: 15px;
        font-size: 13px;
        line-height: 1.7;
    }

    @media(max-width: 850px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
$pengaduan = $tindaklanjut->pengaduan;

$status = $tindaklanjut->status;

$statusLabel = [
'diproses' => 'Sedang Diproses',
'selesai' => 'Selesai',
'ditolak' => 'Ditolak',
][$status] ?? ucfirst(str_replace('_', ' ', $status));
@endphp

<div class="detail-page">

    {{-- JUDUL DAN TOMBOL --}}
    <div class="detail-heading">
        <div>
            <h3>Detail Tindak Lanjut</h3>
            <p>Informasi lengkap riwayat penanganan pengaduan.</p>
        </div>

        <a href="{{ route('admin.tindaklanjut.index') }}"
            class="detail-btn btn-back">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>


    {{-- HEADER DETAIL --}}
    <div class="detail-hero">

        <div class="hero-label">Nomor Tiket Pengaduan</div>

        <div class="hero-ticket">
            {{ $pengaduan->nomor_tiket ?? '-' }}
        </div>

        <p class="hero-title">
            {{ $pengaduan->judul ?? 'Pengaduan tidak tersedia' }}
        </p>

        <div class="hero-status">
            {{ $statusLabel }}
        </div>

    </div>


    <div class="detail-grid">

        {{-- KOLOM KIRI --}}
        <div>

            {{-- KETERANGAN TINDAK LANJUT --}}
            <div class="detail-card">

                <div class="detail-card-header">
                    <i class="fas fa-clipboard-list"></i>
                    <h5>Keterangan Tindak Lanjut</h5>
                </div>

                <div class="detail-card-body">

                    <div class="detail-item">
                        <div class="detail-label">Isi Tindak Lanjut</div>

                        <div class="detail-note">{{ $tindaklanjut->keterangan ?: 'Tidak ada keterangan.' }}</div>
                    </div>

                    <hr class="detail-divider">

                    <div class="detail-item">
                        <div class="detail-label">Status Penanganan</div>

                        @if($status == 'diproses')
                        <span class="status-badge status-diproses">
                            Sedang Diproses
                        </span>
                        @elseif($status == 'selesai')
                        <span class="status-badge status-selesai">
                            Selesai
                        </span>
                        @elseif($status == 'ditolak')
                        <span class="status-badge status-ditolak">
                            Ditolak
                        </span>
                        @else
                        <span class="status-badge status-lain">
                            {{ $statusLabel }}
                        </span>
                        @endif
                    </div>

                </div>
            </div>


            {{-- INFORMASI PENGADUAN --}}
            <div class="detail-card">

                <div class="detail-card-header">
                    <i class="fas fa-file-alt"></i>
                    <h5>Informasi Pengaduan</h5>
                </div>

                <div class="detail-card-body">

                    <div class="detail-item">
                        <div class="detail-label">Judul Pengaduan</div>
                        <div class="detail-value">
                            {{ $pengaduan->judul ?? '-' }}
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Nomor Tiket</div>
                        <div class="detail-value">
                            {{ $pengaduan->nomor_tiket ?? '-' }}
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Kategori</div>
                        <div class="detail-value">
                            {{ $pengaduan->kategori->nama ?? '-' }}
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Tanggal Kejadian</div>
                        <div class="detail-value">
                            {{ $pengaduan->tanggalkejadian ? \Carbon\Carbon::parse($pengaduan->tanggalkejadian)->format('d F Y') : '-' }}
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Lokasi Kejadian</div>
                        <div class="detail-value">
                            {{ $pengaduan->lokasikejadian ?? '-' }}
                        </div>
                    </div>

                </div>
            </div>

        </div>


        {{-- KOLOM KANAN --}}
        <div>

            {{-- INFORMASI PETUGAS --}}
            <div class="detail-card">

                <div class="detail-card-header">
                    <i class="fas fa-user-shield"></i>
                    <h5>Petugas Penanganan</h5>
                </div>

                <div class="detail-card-body">

                    <div class="detail-item">
                        <div class="detail-label">Nama Petugas</div>
                        <div class="detail-value">
                            {{ $tindaklanjut->petugas->nama ?? 'Belum ditentukan' }}
                        </div>
                    </div>

                    <hr class="detail-divider">

                    <div class="detail-item">
                        <div class="detail-label">Tanggal Tindak Lanjut</div>
                        <div class="detail-value">
                            {{ $tindaklanjut->tanggal ? $tindaklanjut->tanggal->format('d F Y, H:i') . ' WIB' : '-' }}
                        </div>
                    </div>

                </div>
            </div>


            {{-- INFORMASI PENGADU --}}
            <div class="detail-card">

                <div class="detail-card-header">
                    <i class="fas fa-user"></i>
                    <h5>Informasi Pengadu</h5>
                </div>

                <div class="detail-card-body">

                    <div class="detail-item">
                        <div class="detail-label">Nama Pengadu</div>
                        <div class="detail-value">
                            {{ $pengaduan->pengadu->nama ?? '-' }}
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">NIK</div>
                        <div class="detail-value">
                            {{ $pengaduan->pengadu->nik ?? '-' }}
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Nomor HP</div>
                        <div class="detail-value">
                            {{ $pengaduan->pengadu->nohp ?? '-' }}
                        </div>
                    </div>

                </div>
            </div>


            {{-- INFO --}}
            <div class="detail-info">
                <i class="fas fa-info-circle"></i>
                Halaman ini hanya digunakan untuk melihat riwayat tindak lanjut. Pengelolaan tindak lanjut dilakukan oleh petugas.
            </div>

        </div>

    </div>

</div>

@endsection