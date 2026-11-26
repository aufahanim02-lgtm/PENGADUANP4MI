
@extends('layouts.appadmin')

@section('page-title', 'Data Wilayah')

@section('content')

<style>
    .wilayah-page {
        padding: 10px 0 30px;
    }

    .wilayah-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .wilayah-heading h3 {
        color: #172554;
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .wilayah-heading p {
        color: #64748b;
        font-size: 14px;
        margin: 0;
    }

    .btn-tambah {
        background: #2563eb;
        color: white;
        padding: 11px 17px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
    }

    .btn-tambah:hover {
        background: #1d4ed8;
        color: white;
    }

    .wilayah-stat {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 13px;
        padding: 20px;
        height: 100%;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .04);
    }

    .stat-label {
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .stat-number {
        color: #172554;
        font-size: 27px;
        font-weight: 800;
    }

    .stat-icon {
        width: 43px;
        height: 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        font-size: 20px;
    }

    .icon-blue {
        color: #2563eb;
        background: #dbeafe;
    }

    .wilayah-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .04);
    }

    .wilayah-card-header {
        padding: 20px 22px;
        border-bottom: 1px solid #e2e8f0;
    }

    .wilayah-card-header h5 {
        color: #172554;
        font-size: 16px;
        font-weight: 800;
        margin: 0;
    }

    .filter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 18px;
    }

    .filter-form .form-control {
        min-height: 40px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 13px;
    }

    .btn-filter {
        background: #2563eb;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 9px 17px;
        font-size: 13px;
        font-weight: 700;
    }

    .btn-reset {
        background: #f1f5f9;
        color: #475569;
        border-radius: 8px;
        padding: 9px 15px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
    }

    .table-responsive {
        padding: 0 20px 15px;
    }

    .table thead th {
        color: #64748b;
        background: #f8fafc;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .4px;
        padding: 14px 12px;
        white-space: nowrap;
        border-bottom: 1px solid #e2e8f0;
    }

    .table tbody td {
        color: #334155;
        font-size: 13px;
        padding: 15px 12px;
        vertical-align: middle;
    }

    .wilayah-name {
        color: #172554;
        font-weight: 700;
    }

    .action-group {
        display: flex;
        gap: 6px;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        border-radius: 7px;
        text-decoration: none;
        font-size: 14px;
        cursor: pointer;
    }

    .btn-show {
        color: #2563eb;
        background: #dbeafe;
    }

    .btn-edit {
        color: #b45309;
        background: #fef3c7;
    }

    .btn-delete {
        color: #dc2626;
        background: #fee2e2;
    }

    .empty-data {
        text-align: center;
        padding: 40px 15px !important;
        color: #94a3b8 !important;
    }

    @media(max-width: 576px) {
        .wilayah-heading h3 {
            font-size: 21px;
        }

        .btn-tambah {
            width: 100%;
            text-align: center;
        }

        .filter-form .form-control {
            max-width: 100% !important;
            width: 100%;
        }
    }
</style>

<div class="wilayah-page">

    {{-- HEADER --}}
    <div class="wilayah-heading">
        <div>
            <h3>Data Wilayah</h3>
            <p>Kelola data provinsi, kabupaten, kecamatan, dan desa.</p>
        </div>

        <a href="{{ route('admin.wilayah.create') }}" class="btn-tambah">
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Wilayah
        </a>
    </div>

    {{-- PESAN SUKSES --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- PESAN ERROR --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}

            <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="wilayah-stat">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Total Wilayah</div>
                        <div class="stat-number">
                            {{ $totalWilayah }}
                        </div>
                    </div>

                    <div class="stat-icon icon-blue">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- TABEL WILAYAH --}}
    <div class="wilayah-card">

        <div class="wilayah-card-header">

            <h5>
                <i class="bi bi-map me-2"></i>
                Daftar Data Wilayah
            </h5>

            {{-- PENCARIAN --}}
            <form action="{{ route('admin.wilayah.index') }}"
                method="GET"
                class="filter-form">

                <input type="text"
                    name="cari"
                    class="form-control"
                    style="max-width: 350px;"
                    placeholder="Cari provinsi, kabupaten, kecamatan, desa..."
                    value="{{ request('cari') }}">

                <button type="submit" class="btn-filter">
                    <i class="bi bi-search me-1"></i>
                    Cari
                </button>

                <a href="{{ route('admin.wilayah.index') }}"
                    class="btn-reset">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>
                    Reset
                </a>

            </form>

        </div>

        {{-- TABEL --}}
        <div class="table-responsive">

            <table class="table table-hover mb-0">

                <thead>
                    <tr>
                        <th width="55">No.</th>
                        <th>Provinsi</th>
                        <th>Kabupaten</th>
                        <th>Kecamatan</th>
                        <th>Desa</th>
                        <th width="130">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($data as $item)

                        <tr>

                            <td>
                                {{ $data->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <div class="wilayah-name">
                                    {{ $item->provinsi }}
                                </div>
                            </td>

                            <td>
                                {{ $item->kabupaten }}
                            </td>

                            <td>
                                {{ $item->kecamatan ?: '-' }}
                            </td>

                            <td>
                                {{ $item->desa ?: '-' }}
                            </td>

                            <td>

                                <div class="action-group">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('admin.wilayah.show', $item->idwilayah) }}"
                                        class="btn-action btn-show"
                                        title="Detail">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.wilayah.edit', $item->idwilayah) }}"
                                        class="btn-action btn-edit"
                                        title="Edit">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>

                                    {{-- HAPUS --}}
                                    <form action="{{ route('admin.wilayah.destroy', $item->idwilayah) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data wilayah ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn-action btn-delete"
                                            title="Hapus">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="empty-data">

                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>

                                Data wilayah belum tersedia.

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 px-4 pb-4">

            <small class="text-muted">
                Menampilkan {{ $data->firstItem() ?? 0 }}
                sampai {{ $data->lastItem() ?? 0 }}
                dari {{ $data->total() }} data
            </small>

            {{ $data->links() }}

        </div>

    </div>

</div>

@endsection
