@extends('layouts.apppengadu')

@section('page-title', 'Dashboard Pengadu')

@push('styles')
<style>
    .welcome-card {
        background: linear-gradient(120deg, #116b55, #15936f);
        color: white;
        padding: 28px;
        border-radius: 16px;
        margin-bottom: 25px;
    }

    .welcome-card h4 {
        font-weight: 700;
        margin-bottom: 8px;
    }

    .welcome-card p {
        margin-bottom: 0;
        opacity: .9;
    }

    .stat-card {
        background: white;
        border-radius: 14px;
        padding: 22px;
        border: 1px solid #e9edf0;
        height: 100%;
        transition: .2s;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 22px rgba(0, 0, 0, .06);
    }

    .stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        margin-bottom: 15px;
    }

    .stat-card h3 {
        font-weight: 700;
        margin-bottom: 4px;
        color: #263238;
    }

    .stat-card p {
        color: #7b8790;
        margin: 0;
        font-size: 13px;
    }

    .dashboard-panel {
        background: white;
        border: 1px solid #e9edf0;
        border-radius: 14px;
        padding: 22px;
    }

    .dashboard-panel h5 {
        font-weight: 700;
        color: #263238;
    }

    .table-dashboard th {
        color: #718096;
        font-size: 12px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .table-dashboard td {
        vertical-align: middle;
        font-size: 13px;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-menunggu {
        background: #fff3cd;
        color: #856404;
    }

    .status-diproses {
        background: #cfe2ff;
        color: #084298;
    }

    .status-selesai {
        background: #d1e7dd;
        color: #0f5132;
    }

    .status-ditolak {
        background: #f8d7da;
        color: #842029;
    }

    .empty-state {
        padding: 35px 15px;
        text-align: center;
        color: #87919a;
    }

    .empty-state i {
        font-size: 38px;
        display: block;
        margin-bottom: 12px;
    }
</style>
@endpush

@section('content')

{{-- SELAMAT DATANG --}}
<div class="welcome-card">
    <h4>Selamat Datang, {{ auth('pengadu')->user()->nama ?? 'Pengadu' }}!</h4>
    <p>
        Selamat datang di Portal Pengaduan P4MI.
        Pantau perkembangan pengaduan Anda melalui halaman ini.
    </p>
</div>

{{-- RINGKASAN --}}
<div class="row g-3 mb-4">

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-primary-subtle text-primary">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <h3>{{ $jumlahPengaduan }}</h3>
            <p>Total Pengaduan</p>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-warning-subtle text-warning">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <h3>{{ $jumlahMenunggu }}</h3>
            <p>Menunggu Verifikasi</p>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-info-subtle text-info">
                <i class="bi bi-arrow-repeat"></i>
            </div>
            <h3>{{ $jumlahDiproses }}</h3>
            <p>Sedang Diproses</p>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-success-subtle text-success">
                <i class="bi bi-check-circle"></i>
            </div>
            <h3>{{ $jumlahSelesai }}</h3>
            <p>Pengaduan Selesai</p>
        </div>
    </div>

</div>

{{-- PENGADUAN DITOLAK --}}
<div class="row g-3 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-danger-subtle text-danger">
                <i class="bi bi-x-circle"></i>
            </div>
            <h3>{{ $jumlahDitolak }}</h3>
            <p>Pengaduan Ditolak</p>
        </div>
    </div>
</div>

{{-- DAFTAR PENGADUAN TERBARU --}}
<div class="dashboard-panel">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="mb-1">Pengaduan Terbaru</h5>
            <small class="text-muted">
                Lima pengaduan terakhir yang Anda buat
            </small>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-dashboard table-hover align-middle mb-0">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nomor Tiket</th>
                    <th>Judul Pengaduan</th>
                    <th>Kategori</th>
                    <th>Tanggal Kejadian</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($pengaduanTerbaru as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <strong>
                            {{ $item->nomor_tiket ?? '-' }}
                        </strong>
                    </td>

                    <td>
                        {{ $item->judul ?? '-' }}
                    </td>

                    <td>
                        {{ $item->kategori->nama ?? '-' }}
                    </td>

                    <td>
                        {{ $item->tanggalkejadian
                                ? \Carbon\Carbon::parse($item->tanggalkejadian)->format('d-m-Y')
                                : '-' }}
                    </td>

                    <td>
                        @php
                        $status = $item->status;

                        $statusClass = match ($status) {
                        'menunggu_verifikasi' => 'status-menunggu',
                        'diproses' => 'status-diproses',
                        'selesai' => 'status-selesai',
                        'ditolak' => 'status-ditolak',
                        default => 'bg-secondary-subtle text-secondary',
                        };

                        $statusLabel = match ($status) {
                        'menunggu_verifikasi' => 'Menunggu Verifikasi',
                        'diproses' => 'Diproses',
                        'selesai' => 'Selesai',
                        'ditolak' => 'Ditolak',
                        default => ucfirst(str_replace('_', ' ', $status ?? '-')),
                        };
                        @endphp

                        <span class="status-badge {{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <strong>Belum Ada Pengaduan</strong>
                            <p class="mb-0 mt-1">
                                Pengaduan yang Anda buat akan ditampilkan di sini.
                            </p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection