@extends('layouts.apppengadu')

@section('page-title', 'Data PMI')

@section('content')

<style>
    .pmi-header {
        background: linear-gradient(135deg, #14532d, #166534);
        color: white;
        padding: 25px;
        border-radius: 15px;
        margin-bottom: 25px;
    }

    .pmi-header h4 {
        font-weight: 700;
        margin-bottom: 8px;
    }

    .pmi-header p {
        margin: 0;
        opacity: .85;
    }

    .pmi-stat {
        background: white;
        border-radius: 13px;
        padding: 20px;
        border: 1px solid #e5e7eb;
        margin-bottom: 22px;
    }

    .pmi-stat .stat-label {
        color: #64748b;
        font-size: 13px;
    }

    .pmi-stat h3 {
        font-weight: 700;
        color: #166534;
        margin: 7px 0 0;
    }

    .pmi-card {
        background: white;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    .pmi-card-header {
        padding: 20px;
        border-bottom: 1px solid #e5e7eb;
    }

    .pmi-card-header h5 {
        font-weight: 700;
        margin: 0;
        color: #1e293b;
    }

    .pmi-table th {
        background: #f8fafc;
        color: #475569;
        font-size: 12px;
        text-transform: uppercase;
        white-space: nowrap;
        padding: 14px;
    }

    .pmi-table td {
        padding: 14px;
        vertical-align: middle;
        font-size: 13px;
    }

    .pmi-name {
        font-weight: 600;
        color: #1e293b;
    }

    .pmi-subtitle {
        color: #94a3b8;
        font-size: 12px;
        margin-top: 3px;
    }

    .pmi-action {
        display: flex;
        gap: 7px;
        justify-content: center;
        align-items: center;
    }

    .pmi-action .btn {
        width: 34px;
        height: 34px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }

    .pmi-action form {
        margin: 0;
    }

    .pmi-empty {
        padding: 45px 20px;
        text-align: center;
        color: #64748b;
    }

    .pmi-empty i {
        font-size: 42px;
        color: #94a3b8;
        display: block;
        margin-bottom: 12px;
    }

    .pmi-search {
        max-width: 350px;
    }

    @media (max-width: 768px) {
        .pmi-header {
            padding: 20px;
        }

        .pmi-search {
            max-width: 100%;
        }

        .pmi-card-header {
            gap: 15px;
            align-items: stretch !important;
            flex-direction: column;
        }
    }
</style>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="pmi-header d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h4>
                <i class="bi bi-person-vcard me-2"></i>
                Data PMI
            </h4>
            <p>Kelola data Pekerja Migran Indonesia milik Anda.</p>
        </div>

        <a href="{{ route('pengadu.pmi.create') }}"
            class="btn btn-light fw-semibold">
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Data PMI
        </a>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- TOTAL PMI --}}
    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class="pmi-stat">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-label">Total Data PMI Saya</div>
                        <h3>{{ $totalPmi }}</h3>
                    </div>

                    <i class="bi bi-people-fill fs-1 text-success opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL DATA PMI --}}
    <div class="pmi-card">

        <div class="pmi-card-header d-flex justify-content-between align-items-center flex-wrap">

            <div>
                <h5>Daftar Data PMI</h5>
                <small class="text-muted">
                    Informasi pekerja migran yang telah didaftarkan.
                </small>
            </div>

            <form action="{{ route('pengadu.pmi.index') }}"
                method="GET"
                class="pmi-search">

                <div class="input-group">
                    <input type="text"
                        name="cari"
                        class="form-control"
                        placeholder="Cari nama, NIK, negara..."
                        value="{{ request('cari') }}">

                    <button class="btn btn-success" type="submit">
                        <i class="bi bi-search"></i>
                    </button>

                    @if(request('cari'))
                    <a href="{{ route('pengadu.pmi.index') }}"
                        class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg"></i>
                    </a>
                    @endif
                </div>

            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover pmi-table mb-0">

                <thead>
                    <tr>
                        <th width="55">No</th>
                        <th>Nama PMI</th>
                        <th>NIK</th>
                        <th>Jenis Kelamin</th>
                        <th>Negara</th>
                        <th>Perusahaan</th>
                        <th>Status PMI</th>
                        <th class="text-center" width="110">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($data as $index => $pmi)

                    <tr>
                        <td>
                            {{ $data->firstItem() + $index }}
                        </td>

                        <td>
                            <div class="pmi-name">
                                {{ $pmi->nama }}
                            </div>
                            <div class="pmi-subtitle">
                                {{ $pmi->nohp ?? '-' }}
                            </div>
                        </td>

                        <td>{{ $pmi->nik ?? '-' }}</td>

                        <td>{{ $pmi->jeniskelamin ?? '-' }}</td>

                        <td>{{ $pmi->negara ?? '-' }}</td>

                        <td>{{ $pmi->perusahaan ?? '-' }}</td>

                        <td>
                            @php
                            $status = strtolower($pmi->statuspmi ?? '');

                            $warna = match($status) {
                            'aktif' => 'success',
                            'nonaktif', 'tidak aktif' => 'secondary',
                            'cuti' => 'warning',
                            default => 'info'
                            };
                            @endphp

                            @if($pmi->statuspmi)
                            <span class="badge bg-{{ $warna }}">
                                {{ ucfirst($pmi->statuspmi) }}
                            </span>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>

                        {{-- AKSI EDIT DAN HAPUS --}}
                        <td>
                            <div class="pmi-action">

                                {{-- EDIT --}}
                                <a href="{{ route('pengadu.pmi.edit', $pmi->idpmi) }}"
                                    class="btn btn-outline-warning"
                                    title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                {{-- HAPUS --}}
                                <form action="{{ route('pengadu.pmi.destroy', $pmi->idpmi) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data PMI ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="btn btn-outline-danger"
                                        title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </form>

                            </div>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="8">
                            <div class="pmi-empty">
                                <i class="bi bi-person-vcard"></i>

                                <h6 class="fw-bold">Belum Ada Data PMI</h6>

                                <p class="mb-3">
                                    Anda belum memiliki data PMI.
                                    Silakan tambahkan data PMI terlebih dahulu.
                                </p>

                                <a href="{{ route('pengadu.pmi.create') }}"
                                    class="btn btn-success btn-sm">
                                    <i class="bi bi-plus-circle me-1"></i>
                                    Tambah Data PMI
                                </a>
                            </div>
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

        {{-- PAGINATION --}}
        @if($data->hasPages())
        <div class="p-3 border-top">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                <small class="text-muted">
                    Menampilkan {{ $data->firstItem() ?? 0 }}
                    sampai {{ $data->lastItem() ?? 0 }}
                    dari {{ $data->total() }} data
                </small>

                {{ $data->links() }}

            </div>
        </div>
        @endif

    </div>

</div>

@endsection