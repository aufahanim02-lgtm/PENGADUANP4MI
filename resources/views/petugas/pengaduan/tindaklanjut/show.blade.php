@extends('layouts.appetugas')

@section('page-title', 'Detail Tindak Lanjut')

@section('content')

<style>
    .detail-page {
        max-width: 900px;
        padding: 5px;
    }

    .detail-heading {
        margin-bottom: 22px;
    }

    .detail-heading h2 {
        font-size: 23px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
    }

    .detail-heading p {
        color: #64748b;
        font-size: 14px;
        margin: 0;
    }

    .detail-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .detail-card-header {
        padding: 18px 20px;
        border-bottom: 1px solid #e2e8f0;
    }

    .detail-card-header h3 {
        margin: 0;
        font-size: 17px;
        color: #1e293b;
    }

    .detail-body {
        padding: 22px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .detail-item span {
        display: block;
        font-size: 12px;
        color: #64748b;
        margin-bottom: 6px;
    }

    .detail-item strong {
        font-size: 14px;
        color: #334155;
    }

    .detail-description {
        background: #f8fafc;
        padding: 17px;
        border-radius: 9px;
        color: #334155;
        font-size: 14px;
        line-height: 1.8;
        white-space: pre-line;
    }

    .detail-status {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .status-diproses {
        background: #dbeafe;
        color: #1e40af;
    }

    .status-selesai {
        background: #dcfce7;
        color: #166534;
    }

    .status-ditolak {
        background: #fee2e2;
        color: #991b1b;
    }

    .btn-edit {
        display: inline-block;
        background: #1d4ed8;
        color: white;
        text-decoration: none;
        padding: 11px 17px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-back {
        display: inline-block;
        background: #f1f5f9;
        color: #334155;
        text-decoration: none;
        padding: 11px 17px;
        border-radius: 8px;
        font-size: 13px;
    }

    .detail-actions {
        display: flex;
        gap: 9px;
        flex-wrap: wrap;
    }

    @media(max-width: 600px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="detail-page">

    <div class="detail-heading">
        <h2>Detail Tindak Lanjut</h2>
        <p>Informasi lengkap catatan penanganan pengaduan.</p>
    </div>

    <div class="detail-card">
        <div class="detail-card-header">
            <h3>Informasi Pengaduan</h3>
        </div>

        <div class="detail-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <span>Nomor Tiket</span>
                    <strong>{{ $pengaduan->nomor_tiket ?? '-' }}</strong>
                </div>
                <div class="detail-item">
                    <span>Judul Pengaduan</span>
                    <strong>{{ $pengaduan->judul }}</strong>
                </div>
                <div class="detail-item">
                    <span>Nama Pengadu</span>
                    <strong>{{ $pengaduan->pengadu->nama ?? '-' }}</strong>
                </div>
                <div class="detail-item">
                    <span>Status Pengaduan</span>
                    <strong>{{ ucfirst(str_replace('_', ' ', $pengaduan->status)) }}</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="detail-card">
        <div class="detail-card-header">
            <h3>Informasi Tindak Lanjut</h3>
        </div>

        <div class="detail-body">
            <div class="detail-grid" style="margin-bottom:22px;">
                <div class="detail-item">
                    <span>Petugas</span>
                    <strong>{{ $tindaklanjut->petugas->nama ?? '-' }}</strong>
                </div>
                <div class="detail-item">
                    <span>Tanggal Tindak Lanjut</span>
                    <strong>{{ $tindaklanjut->tanggal ? $tindaklanjut->tanggal->format('d-m-Y H:i') : '-' }}</strong>
                </div>
                <div class="detail-item">
                    <span>Status Penanganan</span>
                    <div>
                        <span class="detail-status status-{{ $tindaklanjut->status }}">
                            {{ ucfirst($tindaklanjut->status) }}
                        </span>
                    </div>
                </div>
                <div class="detail-item">
                    <span>ID Tindak Lanjut</span>
                    <strong>{{ $tindaklanjut->idtindaklanjut }}</strong>
                </div>
            </div>

            <div class="detail-item" style="margin-bottom:9px;">
                <span>Keterangan Tindak Lanjut</span>
            </div>

            <div class="detail-description">{{ $tindaklanjut->keterangan }}</div>
        </div>
    </div>

    <div class="detail-actions">
        <a href="{{ route('petugas.pengaduan.tindaklanjut.edit', [$pengaduan->idpengaduan, $tindaklanjut->idtindaklanjut]) }}"
            class="btn-edit">Edit Tindak Lanjut</a>

        <a href="{{ route('petugas.pengaduan.tindaklanjut.index', $pengaduan->idpengaduan) }}"
            class="btn-back">Kembali ke Daftar</a>
    </div>

</div>

@endsection