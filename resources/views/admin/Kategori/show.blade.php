@extends('layouts.appadmin')

@section('page-title', 'Detail Kategori')

@section('content')

<style>
    .kategori-detail-page {
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
        font-size: 14px;
        margin: 0;
    }

    .detail-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .04);
    }

    .detail-card-header {
        padding: 20px 25px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }

    .detail-card-header h5 {
        color: #172554;
        font-size: 16px;
        font-weight: 800;
        margin: 0;
    }

    .detail-card-body {
        padding: 28px;
    }

    .kategori-icon {
        width: 75px;
        height: 75px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #dbeafe;
        color: #2563eb;
        border-radius: 18px;
        font-size: 32px;
        margin: 0 auto 15px;
    }

    .kategori-name {
        color: #172554;
        font-size: 23px;
        font-weight: 800;
        text-align: center;
        margin-bottom: 8px;
    }

    .kategori-subtitle {
        color: #64748b;
        font-size: 13px;
        text-align: center;
    }

    .detail-divider {
        border: 0;
        border-top: 1px solid #e2e8f0;
        margin: 28px 0;
    }

    .detail-item {
        margin-bottom: 23px;
    }

    .detail-label {
        display: block;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 8px;
    }

    .detail-value {
        color: #1e293b;
        font-size: 14px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .description-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 16px;
        color: #334155;
        font-size: 14px;
        line-height: 1.7;
        min-height: 75px;
        white-space: pre-line;
    }

    .badge-aktif,
    .badge-nonaktif {
        display: inline-block;
        padding: 7px 13px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .badge-aktif {
        color: #15803d;
        background: #dcfce7;
    }

    .badge-nonaktif {
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
        color: white;
        background: #2563eb;
    }

    .btn-edit:hover {
        color: white;
        background: #1d4ed8;
    }

    @media(max-width: 576px) {
        .detail-card-body {
            padding: 18px;
        }

        .detail-heading h3 {
            font-size: 21px;
        }

        .detail-actions {
            flex-direction: column;
        }

        .detail-actions .btn-detail {
            justify-content: center;
        }
    }
</style>

<div class="kategori-detail-page">

    {{-- HEADER --}}
    <div class="detail-heading">
        <div>
            <h3>Detail Kategori</h3>
            <p>Informasi lengkap kategori pengaduan PMI.</p>
        </div>

        <a href="{{ route('admin.kategori.index') }}"
            class="btn-detail btn-back">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- DETAIL CARD --}}
    <div class="detail-card">

        <div class="detail-card-header">
            <h5>
                <i class="bi bi-tags me-2"></i>
                Informasi Kategori
            </h5>
        </div>

        <div class="detail-card-body">

            {{-- IDENTITAS KATEGORI --}}
            <div class="kategori-icon">
                <i class="bi bi-tag"></i>
            </div>

            <div class="kategori-name">
                {{ $kategori->nama }}
            </div>

            <div class="kategori-subtitle">
                Kategori Pengaduan P4MI
            </div>

            <hr class="detail-divider">

            {{-- INFORMASI --}}
            <div class="row">

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">ID Kategori</span>
                        <div class="detail-value">
                            #{{ $kategori->idkategori }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Nama Kategori</span>
                        <div class="detail-value">
                            {{ $kategori->nama }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Status Kategori</span>
                        <div class="detail-value">
                            @if ($kategori->aktif)
                            <span class="badge-aktif">
                                <i class="bi bi-check-circle me-1"></i>
                                Aktif
                            </span>
                            @else
                            <span class="badge-nonaktif">
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
                            {{ $kategori->created_at?->format('d-m-Y H:i') ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Terakhir Diperbarui</span>
                        <div class="detail-value">
                            {{ $kategori->updated_at?->format('d-m-Y H:i') ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="detail-item">
                        <span class="detail-label">Deskripsi Kategori</span>
                        <div class="description-box">
                            {{ $kategori->deskripsi ?: 'Belum ada deskripsi untuk kategori ini.' }}
                        </div>
                    </div>
                </div>

            </div>

            <hr class="detail-divider">

            {{-- ACTION --}}
            <div class="detail-actions">

                <a href="{{ route('admin.kategori.index') }}"
                    class="btn-detail btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Data Kategori
                </a>

                <a href="{{ route('admin.kategori.edit', $kategori->idkategori) }}"
                    class="btn-detail btn-edit">
                    <i class="bi bi-pencil-square"></i>
                    Edit Kategori
                </a>

            </div>

        </div>
    </div>

</div>

@endsection