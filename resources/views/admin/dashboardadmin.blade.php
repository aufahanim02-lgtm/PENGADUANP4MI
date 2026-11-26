@extends('layouts.appadmin')

@section('page-title', 'Dashboard Admin')

@section('content')

<style>
    .dashboard-page {
        padding: 10px 0 30px;
    }

    .dashboard-heading {
        margin-bottom: 25px;
    }

    .dashboard-heading h3 {
        color: #172554;
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .dashboard-heading p {
        color: #64748b;
        font-size: 13px;
        margin: 0;
    }

    .dashboard-card {
        background: #fff;
        border: 1px solid #e8eef7;
        border-radius: 16px;
        padding: 20px;
        height: 100%;
        box-shadow: 0 5px 20px rgba(15, 23, 42, .04);
        transition: .2s ease;
        display: block;
        color: inherit;
        text-decoration: none;
    }

    .dashboard-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(37, 99, 235, .09);
        border-color: #bfdbfe;
    }

    .dashboard-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .dashboard-icon {
        width: 45px;
        height: 45px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
    }

    .icon-blue {
        background: #eff6ff;
        color: #2563eb;
    }

    .icon-purple {
        background: #f5f3ff;
        color: #7c3aed;
    }

    .icon-green {
        background: #ecfdf5;
        color: #059669;
    }

    .icon-orange {
        background: #fff7ed;
        color: #ea580c;
    }

    .icon-red {
        background: #fef2f2;
        color: #dc2626;
    }

    .icon-cyan {
        background: #ecfeff;
        color: #0891b2;
    }

    .icon-pink {
        background: #fdf2f8;
        color: #db2777;
    }

    .icon-yellow {
        background: #fefce8;
        color: #ca8a04;
    }

    .dashboard-arrow {
        color: #94a3b8;
        font-size: 17px;
    }

    .dashboard-card h2 {
        color: #172554;
        font-size: 29px;
        font-weight: 800;
        margin: 0 0 5px;
    }

    .dashboard-card p {
        color: #64748b;
        font-size: 12px;
        margin: 0;
    }

    .dashboard-section {
        background: #fff;
        border: 1px solid #e8eef7;
        border-radius: 16px;
        padding: 23px;
        box-shadow: 0 5px 20px rgba(15, 23, 42, .04);
        margin-top: 25px;
    }

    .section-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .section-heading h5 {
        color: #172554;
        font-size: 17px;
        font-weight: 800;
        margin: 0;
    }

    .section-heading p {
        color: #94a3b8;
        font-size: 12px;
        margin: 5px 0 0;
    }

    .quick-info {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px;
        background: #f8fbff;
        border: 1px solid #e8eef7;
        border-radius: 12px;
        height: 100%;
    }

    .quick-info-icon {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eff6ff;
        color: #2563eb;
        font-size: 18px;
        flex-shrink: 0;
    }

    .quick-info small {
        display: block;
        color: #94a3b8;
        font-size: 10px;
        margin-bottom: 4px;
    }

    .quick-info strong {
        color: #334155;
        font-size: 13px;
    }

    .dashboard-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 750px;
    }

    .dashboard-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 14px 12px;
        border-bottom: 1px solid #e2e8f0;
        white-space: nowrap;
    }

    .dashboard-table tbody td {
        color: #475569;
        font-size: 12px;
        padding: 15px 12px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .dashboard-table tbody tr:last-child td {
        border-bottom: none;
    }

    .ticket-number {
        color: #2563eb;
        font-weight: 700;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-menunggu_verifikasi {
        background: #fff7ed;
        color: #c2410c;
    }

    .status-diverifikasi {
        background: #eff6ff;
        color: #1d4ed8;
    }

    .status-perlu_perbaikan {
        background: #fef2f2;
        color: #b91c1c;
    }

    .status-diproses {
        background: #f5f3ff;
        color: #6d28d9;
    }

    .status-selesai {
        background: #ecfdf5;
        color: #047857;
    }

    .status-ditolak {
        background: #fef2f2;
        color: #b91c1c;
    }

    .dashboard-action {
        display: inline-block;
        color: #2563eb;
        background: #eff6ff;
        padding: 9px 14px;
        border-radius: 9px;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
    }

    .dashboard-action:hover {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .empty-data {
        text-align: center;
        padding: 40px 15px !important;
        color: #94a3b8 !important;
    }

    .empty-data span {
        display: block;
        font-size: 30px;
        margin-bottom: 10px;
    }

    .notification-info {
        background: #f8fbff;
        border: 1px solid #e8eef7;
        border-radius: 13px;
        padding: 20px;
        height: 100%;
    }

    .notification-info small {
        color: #64748b;
        font-size: 12px;
        display: block;
        margin-bottom: 8px;
    }

    .notification-info h3 {
        color: #172554;
        font-size: 26px;
        font-weight: 800;
        margin: 0;
    }

    @media(max-width: 768px) {
        .dashboard-heading h3 {
            font-size: 21px;
        }

        .dashboard-section {
            padding: 17px;
        }

        .dashboard-card {
            padding: 17px;
        }
    }
</style>

@php
$statusLabel = [
'menunggu_verifikasi' => 'Menunggu Verifikasi',
'diverifikasi' => 'Diverifikasi',
'perlu_perbaikan' => 'Perlu Perbaikan',
'diproses' => 'Diproses',
'selesai' => 'Selesai',
'ditolak' => 'Ditolak',
];
@endphp

<div class="dashboard-page">

    {{-- HEADER --}}
    <div class="dashboard-heading">
        <h3>Dashboard Administrator</h3>
        <p>
            Selamat datang di halaman Dashboard Aplikasi Pengaduan P4MI.
            Berikut ringkasan data dan aktivitas sistem.
        </p>
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

    {{-- STATISTIK UTAMA --}}
    <div class="row g-3">

        {{-- TOTAL USER --}}
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('admin.user.index') }}" class="dashboard-card">
                <div class="dashboard-card-top">
                    <div class="dashboard-icon icon-blue">👤</div>
                    <span class="dashboard-arrow">↗</span>
                </div>
                <h2>{{ $totalUser ?? 0 }}</h2>
                <p>Total Akun Admin dan Petugas</p>
            </a>
        </div>

        {{-- TOTAL ADMIN --}}
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="dashboard-card-top">
                    <div class="dashboard-icon icon-purple">🛡️</div>
                </div>
                <h2>{{ $totalAdmin ?? 0 }}</h2>
                <p>Total Administrator</p>
            </div>
        </div>

        {{-- TOTAL PETUGAS --}}
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="dashboard-card-top">
                    <div class="dashboard-icon icon-green">👨‍💼</div>
                </div>
                <h2>{{ $totalPetugas ?? 0 }}</h2>
                <p>Total Petugas</p>
            </div>
        </div>

        {{-- TOTAL PENGADU --}}
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('admin.pengadu.index') }}" class="dashboard-card">
                <div class="dashboard-card-top">
                    <div class="dashboard-icon icon-cyan">👥</div>
                    <span class="dashboard-arrow">↗</span>
                </div>
                <h2>{{ $totalPengadu ?? 0 }}</h2>
                <p>Total Masyarakat / Pengadu</p>
            </a>
        </div>

        {{-- TOTAL KATEGORI --}}
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('admin.kategori.index') }}" class="dashboard-card">
                <div class="dashboard-card-top">
                    <div class="dashboard-icon icon-orange">📂</div>
                    <span class="dashboard-arrow">↗</span>
                </div>
                <h2>{{ $totalKategori ?? 0 }}</h2>
                <p>Total Kategori Pengaduan</p>
            </a>
        </div>

        {{-- TOTAL WILAYAH --}}
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('admin.wilayah.index') }}" class="dashboard-card">
                <div class="dashboard-card-top">
                    <div class="dashboard-icon icon-pink">📍</div>
                    <span class="dashboard-arrow">↗</span>
                </div>
                <h2>{{ $totalWilayah ?? 0 }}</h2>
                <p>Total Data Wilayah</p>
            </a>
        </div>

        {{-- TOTAL PMI --}}
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('admin.pmi.index') }}" class="dashboard-card">
                <div class="dashboard-card-top">
                    <div class="dashboard-icon icon-cyan">🌍</div>
                    <span class="dashboard-arrow">↗</span>
                </div>
                <h2>{{ $totalPmi ?? 0 }}</h2>
                <p>Total Pekerja Migran Indonesia</p>
            </a>
        </div>

        {{-- TOTAL PENGADUAN --}}
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="dashboard-card-top">
                    <div class="dashboard-icon icon-red">📋</div>
                </div>
                <h2>{{ $totalPengaduan ?? 0 }}</h2>
                <p>Total Pengaduan Masuk</p>
            </div>
        </div>

    </div>

    {{-- RINGKASAN STATUS PENGADUAN --}}
    <div class="dashboard-section">

        <div class="section-heading">
            <div>
                <h5>Ringkasan Status Pengaduan</h5>
                <p>Jumlah pengaduan berdasarkan status penanganan.</p>
            </div>
        </div>

        <div class="row g-3">

            <div class="col-xl-4 col-md-6">
                <div class="quick-info">
                    <div class="quick-info-icon">⏳</div>
                    <div>
                        <small>Menunggu Verifikasi</small>
                        <strong>{{ $pengaduanMenunggu ?? 0 }} Pengaduan</strong>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="quick-info">
                    <div class="quick-info-icon">🔍</div>
                    <div>
                        <small>Diverifikasi</small>
                        <strong>{{ $pengaduanDiverifikasi ?? 0 }} Pengaduan</strong>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="quick-info">
                    <div class="quick-info-icon">⚙️</div>
                    <div>
                        <small>Sedang Diproses</small>
                        <strong>{{ $pengaduanDiproses ?? 0 }} Pengaduan</strong>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="quick-info">
                    <div class="quick-info-icon">🛠️</div>
                    <div>
                        <small>Perlu Perbaikan</small>
                        <strong>{{ $pengaduanPerluPerbaikan ?? 0 }} Pengaduan</strong>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="quick-info">
                    <div class="quick-info-icon">✅</div>
                    <div>
                        <small>Pengaduan Selesai</small>
                        <strong>{{ $pengaduanSelesai ?? 0 }} Pengaduan</strong>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="quick-info">
                    <div class="quick-info-icon">❌</div>
                    <div>
                        <small>Pengaduan Ditolak</small>
                        <strong>{{ $pengaduanDitolak ?? 0 }} Pengaduan</strong>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- STATISTIK NOTIFIKASI --}}
    <div class="dashboard-section">

        <div class="section-heading">
            <div>
                <h5>Informasi Notifikasi</h5>
                <p>Ringkasan notifikasi yang tersimpan di dalam sistem.</p>
            </div>
        </div>

        <div class="row g-3">

            <div class="col-md-6">
                <div class="notification-info">
                    <small>📨 Total Notifikasi</small>
                    <h3>{{ $totalNotifikasi ?? 0 }}</h3>
                </div>
            </div>

            <div class="col-md-6">
                <div class="notification-info">
                    <small>🔔 Notifikasi Belum Dibaca</small>
                    <h3>{{ $notifikasiBelumDibaca ?? 0 }}</h3>
                </div>
            </div>

        </div>
    </div>

    {{-- TABEL PENGADUAN TERBARU --}}
    <div class="dashboard-section">

        <div class="section-heading">
            <div>
                <h5>Pengaduan Terbaru</h5>
                <p>Lima pengaduan terakhir yang masuk ke dalam sistem.</p>
            </div>
        </div>

        <div class="table-responsive">

            <table class="dashboard-table">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nomor Tiket</th>
                        <th>Nama Pengadu</th>
                        <th>Judul Pengaduan</th>
                        <th>Kategori</th>
                        <th>Petugas</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($pengaduanTerbaru ?? [] as $index => $item)

                    @php
                    $status = $item->status ?? '';
                    @endphp

                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td>
                            <span class="ticket-number">
                                {{ $item->nomor_tiket ?? 'Belum ada tiket' }}
                            </span>
                        </td>

                        <td>
                            {{ $item->pengadu->nama ?? 'Data pengadu tidak tersedia' }}
                        </td>

                        <td>
                            {{ $item->judul ?? '-' }}
                        </td>

                        <td>
                            {{ $item->kategori->nama ?? '-' }}
                        </td>

                        <td>
                            {{ $item->petugas->nama ?? 'Belum ditugaskan' }}
                        </td>

                        <td>
                            <span class="status-badge status-{{ $status }}">
                                {{ $statusLabel[$status] ?? ucfirst(str_replace('_', ' ', $status ?: 'Belum ada status')) }}
                            </span>
                        </td>

                        <td>
                            {{ $item->created_at
                                    ? $item->created_at->format('d/m/Y')
                                    : '-' }}
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="8" class="empty-data">
                            <span>📭</span>
                            Belum ada data pengaduan yang masuk.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection