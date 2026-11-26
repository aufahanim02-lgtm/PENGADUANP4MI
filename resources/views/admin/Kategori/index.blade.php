@extends('layouts.appadmin')

@section('page-title', 'Data Kategori')

@section('content')

<style>
    .kategori-page {
        padding: 10px 0 30px;
    }

    .kategori-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .kategori-heading h3 {
        color: #172554;
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .kategori-heading p {
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

    .kategori-stat {
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

    .icon-green {
        color: #15803d;
        background: #dcfce7;
    }

    .icon-red {
        color: #dc2626;
        background: #fee2e2;
    }

    .kategori-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .04);
    }

    .kategori-card-header {
        padding: 20px 22px;
        border-bottom: 1px solid #e2e8f0;
    }

    .kategori-card-header h5 {
        color: #172554;
        font-weight: 800;
        font-size: 16px;
        margin: 0;
    }

    .filter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 18px;
    }

    .filter-form .form-control,
    .filter-form .form-select {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 13px;
        min-height: 40px;
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

    .kategori-name {
        color: #172554;
        font-weight: 700;
    }

    .badge-aktif,
    .badge-nonaktif {
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 11px;
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

    .pagination {
        margin-bottom: 0;
    }

    @media(max-width: 576px) {
        .kategori-heading h3 {
            font-size: 21px;
        }

        .btn-tambah {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="kategori-page">

    {{-- HEADER --}}
    <div class="kategori-heading">
        <div>
            <h3>Data Kategori</h3>
            <p>Kelola kategori pengaduan P4MI.</p>
        </div>

        <a href="{{ route('admin.kategori.create') }}" class="btn-tambah">
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Kategori
        </a>
    </div>

    {{-- PESAN --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="kategori-stat">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Total Kategori</div>
                        <div class="stat-number">{{ $totalKategori }}</div>
                    </div>
                    <div class="stat-icon icon-blue">
                        <i class="bi bi-tags"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="kategori-stat">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Kategori Aktif</div>
                        <div class="stat-number">{{ $kategoriAktif }}</div>
                    </div>
                    <div class="stat-icon icon-green">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="kategori-stat">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Kategori Nonaktif</div>
                        <div class="stat-number">{{ $kategoriNonaktif }}</div>
                    </div>
                    <div class="stat-icon icon-red">
                        <i class="bi bi-x-circle"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- TABEL KATEGORI --}}
    <div class="kategori-card">

        <div class="kategori-card-header">
            <h5>
                <i class="bi bi-list-ul me-2"></i>
                Daftar Kategori Pengaduan
            </h5>

            {{-- FILTER --}}
            <form action="{{ route('admin.kategori.index') }}"
                method="GET"
                class="filter-form">

                <input type="text"
                    name="cari"
                    class="form-control"
                    style="max-width: 280px;"
                    placeholder="Cari nama atau deskripsi..."
                    value="{{ request('cari') }}">

                <select name="aktif" class="form-select" style="max-width: 170px;">
                    <option value="">Semua Status</option>
                    <option value="1" {{ request('aktif') === '1' ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0" {{ request('aktif') === '0' ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>

                <button type="submit" class="btn-filter">
                    <i class="bi bi-search me-1"></i>
                    Cari
                </button>

                <a href="{{ route('admin.kategori.index') }}" class="btn-reset">
                    Reset
                </a>

            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">

                <thead>
                    <tr>
                        <th width="60">No.</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
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
                            <div class="kategori-name">
                                {{ $item->nama }}
                            </div>
                        </td>

                        <td>
                            {{ $item->deskripsi ?: '-' }}
                        </td>

                        <td>
                            @if ($item->aktif)
                            <span class="badge-aktif">Aktif</span>
                            @else
                            <span class="badge-nonaktif">Nonaktif</span>
                            @endif
                        </td>

                        <td>
                            <div class="action-group">

                                <a href="{{ route('admin.kategori.show', $item->idkategori) }}"
                                    class="btn-action btn-show"
                                    title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="{{ route('admin.kategori.edit', $item->idkategori) }}"
                                    class="btn-action btn-edit"
                                    title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('admin.kategori.destroy', $item->idkategori) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
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
                        <td colspan="5" class="empty-data">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Data kategori belum tersedia.
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