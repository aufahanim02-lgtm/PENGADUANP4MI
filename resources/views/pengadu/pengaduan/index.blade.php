@extends('layouts.apppengadu')

@section('page-title', 'Pengaduan Saya')

@section('content')

<style>
    .pengaduan-header {
        background: linear-gradient(135deg, #14532d, #166534);
        color: white;
        padding: 25px;
        border-radius: 15px;
        margin-bottom: 25px;
    }

    .pengaduan-header h4 {
        font-weight: 700;
        margin-bottom: 8px;
    }

    .pengaduan-header p {
        margin: 0;
        opacity: .85;
    }

    .pengaduan-stat {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 13px;
        padding: 20px;
        margin-bottom: 22px;
    }

    .pengaduan-stat small {
        color: #64748b;
        font-size: 13px;
    }

    .pengaduan-stat h3 {
        font-weight: 700;
        margin: 7px 0 0;
        color: #166534;
    }

    .pengaduan-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        overflow: hidden;
    }

    .pengaduan-card-header {
        padding: 20px;
        border-bottom: 1px solid #e5e7eb;
    }

    .pengaduan-card-header h5 {
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .pengaduan-table th {
        background: #f8fafc;
        color: #475569;
        font-size: 12px;
        text-transform: uppercase;
        white-space: nowrap;
        padding: 14px;
    }

    .pengaduan-table td {
        padding: 14px;
        vertical-align: middle;
        font-size: 13px;
    }

    .pengaduan-tiket {
        font-weight: 700;
        color: #166534;
    }

    .pengaduan-judul {
        font-weight: 600;
        color: #1e293b;
    }

    .pengaduan-subtitle {
        color: #94a3b8;
        font-size: 12px;
        margin-top: 4px;
    }

    .pengaduan-action {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
    }

    .pengaduan-action .btn {
        width: 33px;
        height: 33px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }

    .pengaduan-search {
        max-width: 350px;
    }

    .pengaduan-empty {
        padding: 45px 20px;
        text-align: center;
        color: #64748b;
    }

    .pengaduan-empty i {
        font-size: 45px;
        color: #94a3b8;
        display: block;
        margin-bottom: 12px;
    }

    @media (max-width: 768px) {
        .pengaduan-header {
            padding: 20px;
        }

        .pengaduan-search {
            max-width: 100%;
        }

        .pengaduan-card-header {
            flex-direction: column;
            align-items: stretch !important;
            gap: 15px;
        }
    }
</style>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="pengaduan-header d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h4>
                <i class="bi bi-megaphone-fill me-2"></i>
                Pengaduan Saya
            </h4>

            <p>
                Kelola dan pantau perkembangan pengaduan Anda.
            </p>
        </div>

        <a href="{{ route('pengadu.pengaduan.create') }}"
            class="btn btn-light fw-semibold">
            <i class="bi bi-plus-circle me-1"></i>
            Buat Pengaduan
        </a>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- RINGKASAN --}}
    <div class="row">

        <div class="col-md-4 col-sm-6">
            <div class="pengaduan-stat">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small>Total Pengaduan Saya</small>
                        <h3>{{ $totalPengaduan }}</h3>
                    </div>
                    <i class="bi bi-file-earmark-text fs-1 text-success opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6">
            <div class="pengaduan-stat">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small>Menunggu Verifikasi</small>
                        <h3>{{ $menungguVerifikasi }}</h3>
                    </div>
                    <i class="bi bi-hourglass-split fs-1 text-warning opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6">
            <div class="pengaduan-stat">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small>Pengaduan Selesai</small>
                        <h3>{{ $pengaduanSelesai }}</h3>
                    </div>
                    <i class="bi bi-check-circle fs-1 text-success opacity-50"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- DAFTAR PENGADUAN --}}
    <div class="pengaduan-card">

        <div class="pengaduan-card-header d-flex justify-content-between align-items-center flex-wrap">

            <div>
                <h5>Daftar Pengaduan</h5>
                <small class="text-muted">
                    Riwayat pengaduan yang telah Anda kirimkan.
                </small>
            </div>

            {{-- PENCARIAN --}}
            <form action="{{ route('pengadu.pengaduan.index') }}"
                method="GET"
                class="pengaduan-search">

                <div class="input-group">
                    <input type="text"
                        name="cari"
                        class="form-control"
                        placeholder="Cari nomor tiket atau judul..."
                        value="{{ request('cari') }}">

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-search"></i>
                    </button>

                    @if(request('cari'))
                    <a href="{{ route('pengadu.pengaduan.index') }}"
                        class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg"></i>
                    </a>
                    @endif
                </div>

            </form>

        </div>

        {{-- TABEL --}}
        <div class="table-responsive">

            <table class="table table-hover pengaduan-table mb-0">

                <thead>
                    <tr>
                        <th width="55">No</th>
                        <th>Nomor Tiket</th>
                        <th>Judul Pengaduan</th>
                        <th>Kategori</th>
                        <th>Tanggal Kejadian</th>
                        <th>Status</th>
                        <th class="text-center" width="130">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($data as $index => $pengaduan)

                    <tr>

                        <td>
                            {{ $data->firstItem() + $index }}
                        </td>

                        <td>
                            <div class="pengaduan-tiket">
                                {{ $pengaduan->nomor_tiket ?? '-' }}
                            </div>
                        </td>

                        <td>
                            <div class="pengaduan-judul">
                                {{ $pengaduan->judul }}
                            </div>

                            <div class="pengaduan-subtitle">
                                {{ \Illuminate\Support\Str::limit($pengaduan->lokasikejadian ?? '-', 35) }}
                            </div>
                        </td>

                        <td>
                            {{ $pengaduan->kategori->nama ?? '-' }}
                        </td>

                        <td>
                            {{ $pengaduan->tanggalkejadian
                                    ? \Carbon\Carbon::parse($pengaduan->tanggalkejadian)->format('d/m/Y')
                                    : '-' }}
                        </td>

                        {{-- STATUS --}}
                        <td>
                            @php
                            $status = strtolower($pengaduan->status ?? '');

                            $warna = match($status) {
                            'menunggu_verifikasi' => 'warning',
                            'diproses' => 'primary',
                            'selesai' => 'success',
                            'ditolak' => 'danger',
                            default => 'secondary'
                            };

                            $labelStatus = match($status) {
                            'menunggu_verifikasi' => 'Menunggu Verifikasi',
                            'diproses' => 'Sedang Diproses',
                            'selesai' => 'Selesai',
                            'ditolak' => 'Ditolak',
                            default => ucfirst($status ?: 'Belum Ada Status')
                            };
                            @endphp

                            <span class="badge bg-{{ $warna }}">
                                {{ $labelStatus }}
                            </span>
                        </td>

                        {{-- AKSI --}}
                        <td>
                            <div class="pengaduan-action">

                                {{-- DETAIL --}}
                                <a href="{{ route('pengadu.pengaduan.show', $pengaduan->idpengaduan) }}"
                                    class="btn btn-outline-info"
                                    title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>

                                {{-- EDIT --}}
                                @if($pengaduan->status === 'menunggu_verifikasi')
                                <a href="{{ route('pengadu.pengaduan.edit', $pengaduan->idpengaduan) }}"
                                    class="btn btn-outline-warning"
                                    title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                @endif

                            </div>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="7">
                            <div class="pengaduan-empty">

                                <i class="bi bi-file-earmark-text"></i>

                                <h6 class="fw-bold">
                                    Belum Ada Pengaduan
                                </h6>

                                <p class="mb-3">
                                    Anda belum pernah membuat pengaduan.
                                    Silakan buat pengaduan pertama Anda.
                                </p>

                                <a href="{{ route('pengadu.pengaduan.create') }}"
                                    class="btn btn-success btn-sm">
                                    <i class="bi bi-plus-circle me-1"></i>
                                    Buat Pengaduan
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
                    dari {{ $data->total() }} pengaduan
                </small>

                {{ $data->links() }}

            </div>

        </div>
        @endif

    </div>

</div>

@endsection