@extends('layouts.appetugas')

@section('page-title', 'Data Pengaduan')

@section('content')

<style>
    .pengaduan-page {
        padding: 5px;
    }

    .page-heading {
        margin-bottom: 22px;
    }

    .page-heading h2 {
        font-size: 23px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
    }

    .page-heading p {
        color: #64748b;
        margin: 0;
        font-size: 14px;
    }

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 14px;
        margin-bottom: 22px;
    }

    .stat-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 18px;
    }

    .stat-card span {
        color: #64748b;
        font-size: 13px;
    }

    .stat-card h3 {
        font-size: 27px;
        font-weight: 700;
        margin: 9px 0 0;
        color: #1e293b;
    }

    .table-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
    }

    .table-header {
        padding: 20px;
        border-bottom: 1px solid #e2e8f0;
    }

    .table-header h3 {
        margin: 0 0 5px;
        font-size: 17px;
        font-weight: 700;
        color: #1e293b;
    }

    .table-header p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
    }

    .filter-form {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 17px;
    }

    .filter-form input,
    .filter-form select {
        padding: 10px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 13px;
        min-width: 160px;
    }

    .btn-filter {
        background: #1d4ed8;
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 8px;
        cursor: pointer;
    }

    .btn-reset {
        background: #f1f5f9;
        color: #334155;
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .pengaduan-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 850px;
    }

    .pengaduan-table th {
        background: #f8fafc;
        color: #475569;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .4px;
        padding: 14px;
        text-align: left;
    }

    .pengaduan-table td {
        padding: 15px 14px;
        border-top: 1px solid #f1f5f9;
        font-size: 13px;
        color: #334155;
        vertical-align: middle;
    }

    .pengaduan-table tr:hover {
        background: #fafcff;
    }

    .ticket {
        color: #1d4ed8;
        font-weight: 700;
    }

    .status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-menunggu_verifikasi {
        background: #fef3c7;
        color: #92400e;
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

    .btn-detail {
        display: inline-block;
        background: #eff6ff;
        color: #1d4ed8;
        text-decoration: none;
        padding: 7px 12px;
        border-radius: 7px;
        font-weight: 600;
        font-size: 12px;
    }

    .btn-detail:hover {
        background: #dbeafe;
    }

    .empty-state {
        text-align: center;
        padding: 35px 15px !important;
        color: #94a3b8 !important;
    }

    .pagination-wrapper {
        padding: 17px;
    }

    @media(max-width: 1100px) {
        .stat-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media(max-width: 650px) {
        .stat-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .filter-form {
            flex-direction: column;
        }

        .filter-form input,
        .filter-form select,
        .filter-form button,
        .filter-form a {
            width: 100%;
        }
    }
</style>

<div class="pengaduan-page">

    {{-- JUDUL HALAMAN --}}
    <div class="page-heading">
        <h2>Data Pengaduan</h2>
        <p>Kelola, periksa, dan verifikasi pengaduan yang menjadi tanggung jawab Anda.</p>
    </div>

    {{-- STATISTIK --}}
    <div class="stat-grid">

        <div class="stat-card">
            <span>Total Pengaduan</span>
            <h3>{{ $totalPengaduan }}</h3>
        </div>

        <div class="stat-card">
            <span>Menunggu Verifikasi</span>
            <h3>{{ $totalMenunggu }}</h3>
        </div>

        <div class="stat-card">
            <span>Sedang Diproses</span>
            <h3>{{ $totalDiproses }}</h3>
        </div>

        <div class="stat-card">
            <span>Selesai</span>
            <h3>{{ $totalSelesai }}</h3>
        </div>

        <div class="stat-card">
            <span>Ditolak</span>
            <h3>{{ $totalDitolak }}</h3>
        </div>

    </div>

    {{-- TABEL PENGADUAN --}}
    <div class="table-card">

        <div class="table-header">
            <h3>Daftar Pengaduan Masuk</h3>
            <p>Daftar pengaduan yang ditugaskan kepada akun Petugas Anda.</p>

            {{-- FILTER DAN PENCARIAN --}}
            <form action="{{ route('petugas.pengaduan.index') }}"
                method="GET"
                class="filter-form">

                <input
                    type="text"
                    name="cari"
                    placeholder="Cari nomor tiket atau judul..."
                    value="{{ request('cari') }}">

                <select name="status">
                    <option value="">Semua Status</option>
                    <option value="menunggu_verifikasi" {{ request('status') == 'menunggu_verifikasi' ? 'selected' : '' }}>
                        Menunggu Verifikasi
                    </option>
                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>
                        Diproses
                    </option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>
                        Ditolak
                    </option>
                </select>

                <button type="submit" class="btn-filter">
                    Cari
                </button>

                <a href="{{ route('petugas.pengaduan.index') }}" class="btn-reset">
                    Reset
                </a>

            </form>
        </div>

        <div class="table-responsive">
            <table class="pengaduan-table">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nomor Tiket</th>
                        <th>Pengadu</th>
                        <th>Judul Pengaduan</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($pengaduan as $item)

                    <tr>
                        <td>{{ $loop->iteration + ($pengaduan->currentPage() - 1) * $pengaduan->perPage() }}</td>

                        <td>
                            <span class="ticket">
                                {{ $item->nomor_tiket ?? '-' }}
                            </span>
                        </td>

                        <td>
                            {{ $item->pengadu->nama ?? '-' }}
                        </td>

                        <td>
                            {{ $item->judul }}
                        </td>

                        <td>
                            {{ $item->kategori->nama ?? '-' }}
                        </td>

                        <td>
                            {{ $item->created_at ? $item->created_at->format('d-m-Y') : '-' }}
                        </td>

                        <td>
                            <span class="status status-{{ $item->status }}">
                                {{ ucwords(str_replace('_', ' ', $item->status)) }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('petugas.pengaduan.show', $item->idpengaduan) }}"
                                class="btn-detail">
                                Detail
                            </a>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="8" class="empty-state">
                            Belum ada pengaduan yang ditugaskan kepada Anda.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="pagination-wrapper">
            {{ $pengaduan->withQueryString()->links() }}
        </div>

    </div>

</div>

@endsection