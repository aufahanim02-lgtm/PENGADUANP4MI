@extends('layouts.appadmin')

@section('page-title', 'Laporan Pengaduan')

@section('content')

<style>
    .laporan-page {
        padding: 10px 0 30px;
    }

    .laporan-heading {
        margin-bottom: 24px;
    }

    .laporan-heading h3 {
        color: #172554;
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .laporan-heading p {
        color: #64748b;
        font-size: 14px;
        margin: 0;
    }

    .laporan-stat-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 13px;
        margin-bottom: 23px;
    }

    .laporan-stat {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 17px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, .035);
    }

    .laporan-stat-label {
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .laporan-stat-number {
        color: #172554;
        font-size: 25px;
        font-weight: 800;
    }

    .laporan-stat-icon {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        margin-bottom: 12px;
        font-size: 15px;
    }

    .laporan-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        box-shadow: 0 4px 16px rgba(15, 23, 42, .035);
        overflow: hidden;
        margin-bottom: 22px;
    }

    .laporan-card-header {
        padding: 20px 22px;
        border-bottom: 1px solid #e2e8f0;
    }

    .laporan-card-header h5 {
        color: #172554;
        font-size: 16px;
        font-weight: 800;
        margin: 0 0 5px;
    }

    .laporan-card-header p {
        color: #64748b;
        font-size: 12px;
        margin: 0;
    }

    .laporan-filter {
        padding: 21px 22px;
    }

    .laporan-filter-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .laporan-form-group label {
        display: block;
        color: #475569;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .laporan-form-group input,
    .laporan-form-group select {
        width: 100%;
        min-height: 42px;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        padding: 8px 11px;
        font-size: 13px;
        color: #334155;
        outline: none;
        background: white;
    }

    .laporan-form-group input:focus,
    .laporan-form-group select:focus {
        border-color: #2563eb;
    }

    .laporan-filter-actions {
        display: flex;
        gap: 9px;
        margin-top: 18px;
        flex-wrap: wrap;
    }

    .laporan-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 10px 16px;
        border: 0;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
    }

    .laporan-btn-primary {
        background: #1d4ed8;
        color: white;
    }

    .laporan-btn-primary:hover {
        background: #1e40af;
        color: white;
    }

    .laporan-btn-reset {
        background: #f1f5f9;
        color: #475569;
    }

    .laporan-btn-reset:hover {
        background: #e2e8f0;
        color: #172554;
    }

    .laporan-btn-print {
        background: #15803d;
        color: white;
    }

    .laporan-btn-print:hover {
        background: #166534;
        color: white;
    }

    .laporan-table-wrap {
        overflow-x: auto;
    }

    .laporan-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1050px;
    }

    .laporan-table th {
        background: #f8fafc;
        color: #64748b;
        padding: 14px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .4px;
        text-align: left;
        white-space: nowrap;
    }

    .laporan-table td {
        padding: 15px 14px;
        border-top: 1px solid #f1f5f9;
        color: #334155;
        font-size: 12px;
        vertical-align: middle;
    }

    .laporan-table tbody tr:hover {
        background: #f8fafc;
    }

    .laporan-ticket {
        color: #1d4ed8;
        font-weight: 800;
        white-space: nowrap;
    }

    .laporan-main {
        color: #172554;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .laporan-sub {
        color: #94a3b8;
        font-size: 11px;
    }

    .laporan-status {
        display: inline-block;
        padding: 6px 9px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 800;
        white-space: nowrap;
    }

    .status-menunggu {
        background: #fef3c7;
        color: #92400e;
    }

    .status-diproses {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-selesai {
        background: #dcfce7;
        color: #15803d;
    }

    .status-ditolak {
        background: #fee2e2;
        color: #b91c1c;
    }

    .laporan-detail {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 10px;
        background: #eff6ff;
        color: #1d4ed8;
        border-radius: 8px;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .laporan-detail:hover {
        background: #1d4ed8;
        color: white;
    }

    .laporan-empty {
        text-align: center;
        padding: 45px 15px !important;
        color: #94a3b8 !important;
    }

    .laporan-pagination {
        padding: 18px 22px;
        border-top: 1px solid #e2e8f0;
    }

    @media(max-width: 1100px) {
        .laporan-stat-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media(max-width: 750px) {
        .laporan-filter-grid {
            grid-template-columns: 1fr 1fr;
        }

        .laporan-stat-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width: 480px) {

        .laporan-filter-grid,
        .laporan-stat-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="laporan-page">

    {{-- JUDUL --}}
    <div class="laporan-heading">
        <h3>Laporan Pengaduan</h3>
        <p>Rekapitulasi dan pemantauan seluruh laporan pengaduan PMI.</p>
    </div>


    {{-- STATISTIK --}}
    <div class="laporan-stat-grid">

        <div class="laporan-stat">
            <div class="laporan-stat-icon" style="background:#dbeafe;color:#1d4ed8;">
                <i class="fas fa-folder-open"></i>
            </div>
            <div class="laporan-stat-label">Total Pengaduan</div>
            <div class="laporan-stat-number">{{ $totalPengaduan }}</div>
        </div>

        <div class="laporan-stat">
            <div class="laporan-stat-icon" style="background:#fef3c7;color:#d97706;">
                <i class="fas fa-clock"></i>
            </div>
            <div class="laporan-stat-label">Menunggu Verifikasi</div>
            <div class="laporan-stat-number">{{ $totalMenunggu }}</div>
        </div>

        <div class="laporan-stat">
            <div class="laporan-stat-icon" style="background:#dbeafe;color:#2563eb;">
                <i class="fas fa-spinner"></i>
            </div>
            <div class="laporan-stat-label">Sedang Diproses</div>
            <div class="laporan-stat-number">{{ $totalDiproses }}</div>
        </div>

        <div class="laporan-stat">
            <div class="laporan-stat-icon" style="background:#dcfce7;color:#16a34a;">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="laporan-stat-label">Selesai</div>
            <div class="laporan-stat-number">{{ $totalSelesai }}</div>
        </div>

        <div class="laporan-stat">
            <div class="laporan-stat-icon" style="background:#fee2e2;color:#dc2626;">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="laporan-stat-label">Ditolak</div>
            <div class="laporan-stat-number">{{ $totalDitolak }}</div>
        </div>

    </div>


    {{-- FILTER LAPORAN --}}
    <div class="laporan-card">

        <div class="laporan-card-header">
            <h5><i class="fas fa-filter me-2"></i> Filter Laporan</h5>
            <p>Gunakan filter untuk menampilkan laporan sesuai kebutuhan.</p>
        </div>

        <form action="{{ route('admin.laporan.index') }}" method="GET" class="laporan-filter">

            <div class="laporan-filter-grid">

                <div class="laporan-form-group">
                    <label>Tanggal Mulai</label>
                    <input
                        type="date"
                        name="tanggalmulai"
                        value="{{ request('tanggalmulai') }}">
                </div>

                <div class="laporan-form-group">
                    <label>Tanggal Akhir</label>
                    <input
                        type="date"
                        name="tanggalakhir"
                        value="{{ request('tanggalakhir') }}">
                </div>

                <div class="laporan-form-group">
                    <label>Kategori Pengaduan</label>
                    <select name="idkategori">
                        <option value="">Semua Kategori</option>
                        @foreach($kategori as $itemKategori)
                        <option
                            value="{{ $itemKategori->idkategori }}"
                            {{ request('idkategori') == $itemKategori->idkategori ? 'selected' : '' }}>
                            {{ $itemKategori->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="laporan-form-group">
                    <label>Wilayah</label>
                    <select name="idwilayah">
                        <option value="">Semua Wilayah</option>
                        @foreach($wilayah as $itemWilayah)
                        <option
                            value="{{ $itemWilayah->idwilayah }}"
                            {{ request('idwilayah') == $itemWilayah->idwilayah ? 'selected' : '' }}>
                            {{ $itemWilayah->desa ?? $itemWilayah->kecamatan ?? $itemWilayah->kabupaten }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="laporan-form-group">
                    <label>Status Pengaduan</label>
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
                </div>

            </div>

            <div class="laporan-filter-actions">

                <button type="submit" class="laporan-btn laporan-btn-primary">
                    <i class="fas fa-search"></i>
                    Terapkan Filter
                </button>

                <a href="{{ route('admin.laporan.index') }}" class="laporan-btn laporan-btn-reset">
                    <i class="fas fa-undo"></i>
                    Reset
                </a>

                <a
                    href="{{ route('admin.laporan.cetak', request()->query()) }}"
                    target="_blank"
                    class="laporan-btn laporan-btn-print">
                    <i class="fas fa-print"></i>
                    Cetak Laporan
                </a>

            </div>

        </form>
    </div>


    {{-- TABEL LAPORAN --}}
    <div class="laporan-card">

        <div class="laporan-card-header">
            <h5>Daftar Laporan Pengaduan</h5>
            <p>Data pengaduan berdasarkan filter yang dipilih.</p>
        </div>

        <div class="laporan-table-wrap">

            <table class="laporan-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Tiket</th>
                        <th>Judul Pengaduan</th>
                        <th>Nama Pengadu</th>
                        <th>Nama PMI</th>
                        <th>Kategori</th>
                        <th>Wilayah</th>
                        <th>Status</th>
                        <th>Tanggal Laporan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($data as $item)

                    <tr>

                        <td>{{ $data->firstItem() + $loop->index }}</td>

                        <td>
                            <div class="laporan-ticket">
                                {{ $item->nomor_tiket ?? '-' }}
                            </div>
                        </td>

                        <td>
                            <div class="laporan-main">
                                {{ $item->judul }}
                            </div>
                        </td>

                        <td>
                            {{ $item->pengadu->nama ?? '-' }}
                        </td>

                        <td>
                            {{ $item->pmi->nama ?? '-' }}
                        </td>

                        <td>
                            {{ $item->kategori->nama ?? '-' }}
                        </td>

                        <td>
                            {{ $item->wilayah->desa ?? $item->wilayah->kecamatan ?? $item->wilayah->kabupaten ?? '-' }}
                        </td>

                        <td>
                            @if($item->status == 'menunggu_verifikasi')
                            <span class="laporan-status status-menunggu">
                                Menunggu Verifikasi
                            </span>
                            @elseif($item->status == 'diproses')
                            <span class="laporan-status status-diproses">
                                Diproses
                            </span>
                            @elseif($item->status == 'selesai')
                            <span class="laporan-status status-selesai">
                                Selesai
                            </span>
                            @elseif($item->status == 'ditolak')
                            <span class="laporan-status status-ditolak">
                                Ditolak
                            </span>
                            @else
                            <span class="laporan-status">
                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                            </span>
                            @endif
                        </td>

                        <td>
                            {{ $item->created_at ? $item->created_at->format('d/m/Y') : '-' }}
                        </td>

                        <td>
                            <a
                                href="{{ route('admin.pengaduan.show', $item->idpengaduan) }}"
                                class="laporan-detail">
                                <i class="fas fa-eye"></i>
                                Detail
                            </a>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="10" class="laporan-empty">
                            <i class="fas fa-folder-open fa-2x mb-3"></i>
                            <div>Belum ada data laporan pengaduan.</div>
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="laporan-pagination">
            {{ $data->links() }}
        </div>

    </div>

</div>

@endsection