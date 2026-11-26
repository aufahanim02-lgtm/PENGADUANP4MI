@extends('layouts.appadmin')

@section('page-title', 'Detail Data Wilayah')

@section('content')

<style>
    .wilayah-detail-page {
        padding: 10px 0 30px;
    }

    .detail-heading {
        margin-bottom: 24px;
    }

    .detail-heading h3 {
        color: #172554;
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .detail-heading p {
        color: #64748b;
        margin: 0;
    }

    .detail-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 28px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, .04);
    }

    .detail-item {
        padding: 16px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        color: #64748b;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .detail-value {
        color: #172554;
        font-size: 15px;
        font-weight: 600;
    }

    .status-aktif {
        display: inline-block;
        background: #dcfce7;
        color: #15803d;
        padding: 6px 13px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .status-nonaktif {
        display: inline-block;
        background: #fee2e2;
        color: #b91c1c;
        padding: 6px 13px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .btn-edit {
        background: #2563eb;
        color: white;
        border: none;
        border-radius: 9px;
        padding: 11px 20px;
        font-weight: 700;
        text-decoration: none;
    }

    .btn-edit:hover {
        background: #1d4ed8;
        color: white;
    }

    .btn-kembali {
        background: #f1f5f9;
        color: #334155;
        border-radius: 9px;
        padding: 11px 20px;
        font-weight: 700;
        text-decoration: none;
    }

    .btn-kembali:hover {
        background: #e2e8f0;
        color: #0f172a;
    }
</style>

<div class="wilayah-detail-page">

    <div class="detail-heading">
        <h3>Detail Data Wilayah</h3>
        <p>Informasi lengkap wilayah yang tersimpan dalam sistem.</p>
    </div>

    <div class="detail-card">

        <div class="row">

            <div class="col-md-6">
                <div class="detail-item">
                    <div class="detail-label">ID Wilayah</div>
                    <div class="detail-value">
                        {{ $wilayah->idwilayah }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-item">
                    <div class="detail-label">Provinsi</div>
                    <div class="detail-value">
                        {{ $wilayah->provinsi }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-item">
                    <div class="detail-label">Kabupaten/Kota</div>
                    <div class="detail-value">
                        {{ $wilayah->kabupaten }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-item">
                    <div class="detail-label">Kecamatan</div>
                    <div class="detail-value">
                        {{ $wilayah->kecamatan ?: '-' }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-item">
                    <div class="detail-label">Desa/Kampung</div>
                    <div class="detail-value">
                        {{ $wilayah->desa ?: '-' }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-item">
                    <div class="detail-label">Status Wilayah</div>
                    <div class="detail-value">
                        @if($wilayah->aktif)
                        <span class="status-aktif">Aktif</span>
                        @else
                        <span class="status-nonaktif">Tidak Aktif</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-item">
                    <div class="detail-label">Tanggal Dibuat</div>
                    <div class="detail-value">
                        {{ $wilayah->created_at?->format('d-m-Y H:i') ?? '-' }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-item">
                    <div class="detail-label">Terakhir Diperbarui</div>
                    <div class="detail-value">
                        {{ $wilayah->updated_at?->format('d-m-Y H:i') ?? '-' }}
                    </div>
                </div>
            </div>

        </div>

        <hr class="my-4">

        <div class="d-flex justify-content-end gap-2 flex-wrap">

            <a href="{{ route('admin.wilayah.index') }}" class="btn-kembali">
                Kembali
            </a>

            <a href="{{ route('admin.wilayah.edit', $wilayah->idwilayah) }}" class="btn-edit">
                Edit Wilayah
            </a>

        </div>

    </div>

</div>

@endsection