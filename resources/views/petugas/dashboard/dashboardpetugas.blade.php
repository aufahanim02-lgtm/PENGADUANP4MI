@extends('layouts.appetugas')

@section('title', 'Dashboard Petugas - Pengaduan P4MI')

@section('page-title', 'Dashboard Petugas')

@section('content')

@php
$namaPetugas = $petugas->nama ?? 'Petugas';

$statusLabel = [
'menunggu_verifikasi' => 'Menunggu Verifikasi',
'diproses' => 'Sedang Diproses',
'selesai' => 'Selesai',
'ditolak' => 'Ditolak',
];
@endphp

<div class="petugas-dashboard">

    {{-- HEADER SELAMAT DATANG --}}
    <div class="welcome-card">
        <div class="welcome-content">
            <span class="welcome-label">PANEL PETUGAS P4MI</span>

            <h2>
                Selamat datang, {{ $namaPetugas }} 👋
            </h2>

            <p>
                Pantau pengaduan, lakukan pemeriksaan, dan kelola tindak lanjut
                pengaduan Pekerja Migran Indonesia.
            </p>

            <div class="welcome-actions">
                <a href="{{ route('petugas.pengaduan.index') }}" class="btn-welcome">
                    <span>📋</span>
                    Kelola Pengaduan
                </a>

                <a href="{{ route('petugas.pengaduan.create') }}" class="btn-welcome-outline">
                    + Tambah Pengaduan
                </a>
            </div>
        </div>

        <div class="welcome-illustration">
            <div class="illustration-circle">
                📊
            </div>
        </div>
    </div>


    {{-- STATISTIK PENGADUAN --}}
    <div class="section-heading">
        <div>
            <h3>Ringkasan Pengaduan</h3>
            <p>Statistik pengaduan yang menjadi tanggung jawab Anda.</p>
        </div>
    </div>

    <div class="stats-grid">

        <a href="{{ route('petugas.pengaduan.index') }}"
            class="stat-card stat-blue">

            <div class="stat-content">
                <span>Total Pengaduan</span>
                <h2>{{ $totalPengaduan }}</h2>
                <small>Lihat semua pengaduan</small>
            </div>

            <div class="stat-icon">📋</div>
        </a>


        <a href="{{ route('petugas.pengaduan.index') }}"
            class="stat-card stat-orange">

            <div class="stat-content">
                <span>Menunggu Verifikasi</span>
                <h2>{{ $totalMenunggu }}</h2>
                <small>Pengaduan perlu diperiksa</small>
            </div>

            <div class="stat-icon">⏳</div>
        </a>


        <a href="{{ route('petugas.pengaduan.index') }}"
            class="stat-card stat-purple">

            <div class="stat-content">
                <span>Sedang Diproses</span>
                <h2>{{ $totalDiproses }}</h2>
                <small>Pengaduan dalam penanganan</small>
            </div>

            <div class="stat-icon">⚙️</div>
        </a>


        <a href="{{ route('petugas.pengaduan.index') }}"
            class="stat-card stat-green">

            <div class="stat-content">
                <span>Pengaduan Selesai</span>
                <h2>{{ $totalSelesai }}</h2>
                <small>Pengaduan telah diselesaikan</small>
            </div>

            <div class="stat-icon">✓</div>
        </a>


        <a href="{{ route('petugas.pengaduan.index') }}"
            class="stat-card stat-red">

            <div class="stat-content">
                <span>Pengaduan Ditolak</span>
                <h2>{{ $totalDitolak }}</h2>
                <small>Pengaduan yang ditolak</small>
            </div>

            <div class="stat-icon">✕</div>
        </a>

    </div>


    {{-- DAFTAR PENGADUAN TERBARU --}}
    <div class="content-card">

        <div class="card-heading">
            <div>
                <h3>Pengaduan Terbaru</h3>
                <p>Daftar lima pengaduan terbaru yang ditugaskan kepada Anda.</p>
            </div>

            <a href="{{ route('petugas.pengaduan.index') }}" class="btn-view-all">
                Lihat Semua →
            </a>
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
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($pengaduanTerbaru as $item)

                    @php
                    $status = $item->status ?? '';

                    $statusClass = match ($status) {
                    'menunggu_verifikasi' => 'badge-waiting',
                    'diproses' => 'badge-process',
                    'selesai' => 'badge-success',
                    'ditolak' => 'badge-rejected',
                    default => 'badge-default',
                    };
                    @endphp

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <strong class="ticket-number">
                                {{ $item->nomor_tiket ?? '-' }}
                            </strong>
                        </td>

                        <td>
                            <strong>
                                {{ $item->pengadu->nama ?? '-' }}
                            </strong>
                        </td>

                        <td>
                            {{ \Illuminate\Support\Str::limit($item->judul ?? '-', 30) }}
                        </td>

                        <td>
                            {{ $item->kategori->nama ?? '-' }}
                        </td>

                        <td>
                            <span class="status-badge {{ $statusClass }}">
                                {{ $statusLabel[$status] ?? ucwords(str_replace('_', ' ', $status ?: '-')) }}
                            </span>
                        </td>

                        <td>
                            {{ $item->created_at ? $item->created_at->format('d-m-Y') : '-' }}
                        </td>

                        <td>
                            <div class="action-buttons">

                                <a href="{{ route('petugas.pengaduan.show', $item->idpengaduan) }}"
                                    class="btn-action btn-detail"
                                    title="Detail Pengaduan">
                                    Detail
                                </a>

                                <a href="{{ route('petugas.pengaduan.bukti.index', $item->idpengaduan) }}"
                                    class="btn-action btn-proof"
                                    title="Lihat Bukti">
                                    Bukti
                                </a>

                                <a href="{{ route('petugas.pengaduan.tindaklanjut.index', $item->idpengaduan) }}"
                                    class="btn-action btn-followup"
                                    title="Kelola Tindak Lanjut">
                                    Tindak Lanjut
                                </a>

                            </div>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-icon">📭</div>
                                <h4>Belum Ada Pengaduan</h4>
                                <p>
                                    Belum ada pengaduan yang ditugaskan kepada Anda.
                                </p>

                                <a href="{{ route('petugas.pengaduan.index') }}">
                                    Buka Data Pengaduan
                                </a>
                            </div>
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>


    {{-- RINGKASAN STATUS --}}
    <div class="bottom-grid">

        <div class="content-card status-card">

            <div class="card-heading">
                <div>
                    <h3>Ringkasan Status</h3>
                    <p>Jumlah pengaduan berdasarkan status.</p>
                </div>
            </div>

            <div class="status-list">

                <a href="{{ route('petugas.pengaduan.index') }}" class="status-item">
                    <div class="status-left">
                        <span class="status-dot dot-orange"></span>
                        <span>Menunggu Verifikasi</span>
                    </div>
                    <strong>{{ $totalMenunggu }}</strong>
                </a>

                <a href="{{ route('petugas.pengaduan.index') }}" class="status-item">
                    <div class="status-left">
                        <span class="status-dot dot-purple"></span>
                        <span>Sedang Diproses</span>
                    </div>
                    <strong>{{ $totalDiproses }}</strong>
                </a>

                <a href="{{ route('petugas.pengaduan.index') }}" class="status-item">
                    <div class="status-left">
                        <span class="status-dot dot-green"></span>
                        <span>Selesai</span>
                    </div>
                    <strong>{{ $totalSelesai }}</strong>
                </a>

                <a href="{{ route('petugas.pengaduan.index') }}" class="status-item">
                    <div class="status-left">
                        <span class="status-dot dot-red"></span>
                        <span>Ditolak</span>
                    </div>
                    <strong>{{ $totalDitolak }}</strong>
                </a>

            </div>

        </div>


        {{-- AKSES CEPAT --}}
        <div class="content-card quick-card">

            <div class="card-heading">
                <div>
                    <h3>Akses Cepat</h3>
                    <p>Akses halaman pengelolaan petugas.</p>
                </div>
            </div>

            <div class="quick-links">

                <a href="{{ route('petugas.pengaduan.index') }}" class="quick-link">
                    <div class="quick-icon quick-blue">📋</div>
                    <div>
                        <strong>Data Pengaduan</strong>
                        <span>Lihat dan kelola pengaduan</span>
                    </div>
                    <span class="quick-arrow">→</span>
                </a>

                <a href="{{ route('petugas.pengaduan.create') }}" class="quick-link">
                    <div class="quick-icon quick-green">➕</div>
                    <div>
                        <strong>Tambah Pengaduan</strong>
                        <span>Masukkan data pengaduan</span>
                    </div>
                    <span class="quick-arrow">→</span>
                </a>

                @if ($pengaduanTerbaru->isNotEmpty())
                <a href="{{ route('petugas.pengaduan.bukti.index', $pengaduanTerbaru->first()->idpengaduan) }}"
                    class="quick-link">
                    <div class="quick-icon quick-orange">📎</div>
                    <div>
                        <strong>Bukti Pengaduan</strong>
                        <span>Lihat bukti pengaduan terbaru</span>
                    </div>
                    <span class="quick-arrow">→</span>
                </a>

                <a href="{{ route('petugas.pengaduan.tindaklanjut.index', $pengaduanTerbaru->first()->idpengaduan) }}"
                    class="quick-link">
                    <div class="quick-icon quick-purple">📝</div>
                    <div>
                        <strong>Tindak Lanjut</strong>
                        <span>Kelola tindak lanjut pengaduan terbaru</span>
                    </div>
                    <span class="quick-arrow">→</span>
                </a>
                @endif

            </div>

        </div>

    </div>

</div>


<style>
    .petugas-dashboard {
        padding: 5px 0 30px;
        color: #1e293b;
    }

    .welcome-card {
        background: linear-gradient(120deg, #123b78, #1764bd);
        color: white;
        padding: 30px;
        border-radius: 17px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
        overflow: hidden;
        position: relative;
    }

    .welcome-content {
        max-width: 700px;
        position: relative;
        z-index: 1;
    }

    .welcome-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        opacity: .8;
    }

    .welcome-card h2 {
        font-size: 25px;
        font-weight: 800;
        margin: 12px 0 8px;
        color: white;
    }

    .welcome-card p {
        font-size: 13px;
        line-height: 1.7;
        color: #e4efff;
        margin-bottom: 20px;
    }

    .welcome-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .btn-welcome,
    .btn-welcome-outline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        transition: .2s;
    }

    .btn-welcome {
        background: white;
        color: #174b91;
    }

    .btn-welcome:hover {
        background: #eaf2ff;
        color: #123b78;
    }

    .btn-welcome-outline {
        color: white;
        border: 1px solid rgba(255, 255, 255, .6);
    }

    .btn-welcome-outline:hover {
        background: rgba(255, 255, 255, .12);
        color: white;
    }

    .welcome-illustration {
        padding: 20px 45px;
    }

    .illustration-circle {
        width: 115px;
        height: 115px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .15);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        border: 1px solid rgba(255, 255, 255, .2);
    }

    .section-heading {
        margin-bottom: 17px;
    }

    .section-heading h3 {
        font-size: 17px;
        font-weight: 800;
        margin: 0 0 5px;
        color: #172554;
    }

    .section-heading p,
    .card-heading p {
        font-size: 12px;
        color: #8792a5;
        margin: 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 15px;
        margin-bottom: 25px;
    }

    .stat-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        min-height: 125px;
        padding: 18px;
        background: white;
        border: 1px solid #e8edf5;
        border-radius: 13px;
        text-decoration: none;
        color: #1e293b;
        transition: .2s;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 9px 22px rgba(15, 23, 42, .08);
        color: #1e293b;
    }

    .stat-content span {
        display: block;
        color: #758197;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 9px;
    }

    .stat-content h2 {
        font-size: 27px;
        font-weight: 800;
        margin: 0 0 5px;
        color: #172554;
    }

    .stat-content small {
        font-size: 10px;
        color: #94a3b8;
    }

    .stat-icon {
        flex-shrink: 0;
        width: 43px;
        height: 43px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .stat-blue .stat-icon {
        background: #eaf2ff;
        color: #2563eb;
    }

    .stat-orange .stat-icon {
        background: #fff4df;
        color: #d97706;
    }

    .stat-purple .stat-icon {
        background: #f2eaff;
        color: #7c3aed;
    }

    .stat-green .stat-icon {
        background: #e6f8ef;
        color: #16a34a;
    }

    .stat-red .stat-icon {
        background: #feecec;
        color: #dc2626;
    }

    .content-card {
        background: white;
        border: 1px solid #e8edf5;
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .card-heading {
        padding: 19px 21px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        border-bottom: 1px solid #edf1f6;
    }

    .card-heading h3 {
        font-size: 15px;
        font-weight: 800;
        color: #172554;
        margin: 0 0 5px;
    }

    .btn-view-all {
        padding: 9px 13px;
        border-radius: 7px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-view-all:hover {
        background: #dbeafe;
        color: #1e40af;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .dashboard-table {
        width: 100%;
        min-width: 950px;
        border-collapse: collapse;
    }

    .dashboard-table th {
        background: #f8fafc;
        padding: 13px 12px;
        color: #64748b;
        text-align: left;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .dashboard-table td {
        padding: 14px 12px;
        border-top: 1px solid #edf1f6;
        color: #475569;
        font-size: 11px;
        vertical-align: middle;
    }

    .dashboard-table tbody tr:hover {
        background: #fafcff;
    }

    .ticket-number {
        color: #1d4ed8;
        white-space: nowrap;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 9px;
        border-radius: 30px;
        font-size: 9px;
        font-weight: 700;
        white-space: nowrap;
    }

    .badge-waiting {
        color: #a16207;
        background: #fef3c7;
    }

    .badge-process {
        color: #0369a1;
        background: #e0f2fe;
    }

    .badge-success {
        color: #15803d;
        background: #dcfce7;
    }

    .badge-rejected {
        color: #b91c1c;
        background: #fee2e2;
    }

    .badge-default {
        color: #475569;
        background: #e2e8f0;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .btn-action {
        display: inline-block;
        padding: 7px 9px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
        transition: .2s;
    }

    .btn-detail {
        background: #eff6ff;
        color: #1d4ed8;
    }

    .btn-proof {
        background: #fff7ed;
        color: #c2410c;
    }

    .btn-followup {
        background: #f3e8ff;
        color: #7e22ce;
    }

    .btn-action:hover {
        filter: brightness(.95);
        transform: translateY(-1px);
    }

    .empty-state {
        padding: 40px 15px;
        text-align: center;
    }

    .empty-icon {
        font-size: 35px;
        margin-bottom: 10px;
    }

    .empty-state h4 {
        font-size: 15px;
        color: #334155;
        margin-bottom: 7px;
    }

    .empty-state p {
        color: #94a3b8;
        font-size: 12px;
        margin-bottom: 15px;
    }

    .empty-state a {
        display: inline-block;
        background: #1d4ed8;
        color: white;
        padding: 9px 14px;
        border-radius: 7px;
        text-decoration: none;
        font-size: 11px;
    }

    .bottom-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .status-list {
        padding: 8px 20px 15px;
    }

    .status-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 0;
        border-bottom: 1px solid #edf1f6;
        color: #475569;
        text-decoration: none;
        font-size: 12px;
    }

    .status-item:last-child {
        border-bottom: none;
    }

    .status-item:hover {
        color: #1d4ed8;
    }

    .status-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .status-item strong {
        color: #172554;
        font-size: 15px;
    }

    .status-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
    }

    .dot-orange {
        background: #f59e0b;
    }

    .dot-purple {
        background: #8b5cf6;
    }

    .dot-green {
        background: #22c55e;
    }

    .dot-red {
        background: #ef4444;
    }

    .quick-links {
        padding: 8px 20px 15px;
    }

    .quick-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #edf1f6;
        text-decoration: none;
        color: #334155;
    }

    .quick-link:last-child {
        border-bottom: none;
    }

    .quick-link:hover {
        color: #1d4ed8;
    }

    .quick-icon {
        width: 39px;
        height: 39px;
        border-radius: 10px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
    }

    .quick-blue {
        background: #eff6ff;
    }

    .quick-green {
        background: #ecfdf5;
    }

    .quick-orange {
        background: #fff7ed;
    }

    .quick-purple {
        background: #f5f3ff;
    }

    .quick-link div:nth-child(2) {
        flex: 1;
    }

    .quick-link strong {
        display: block;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .quick-link span:not(.quick-arrow) {
        color: #94a3b8;
        font-size: 10px;
    }

    .quick-arrow {
        font-size: 18px;
        color: #94a3b8;
    }

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 850px) {
        .stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .bottom-grid {
            grid-template-columns: 1fr;
        }

        .welcome-illustration {
            padding: 10px;
        }
    }

    @media (max-width: 550px) {
        .welcome-card {
            padding: 22px 18px;
        }

        .welcome-card h2 {
            font-size: 20px;
        }

        .welcome-illustration {
            display: none;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .card-heading {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>

@endsection