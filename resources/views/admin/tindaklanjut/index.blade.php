
@extends('layouts.appadmin')

@section('page-title', 'Data Tindak Lanjut')

@section('content')

<style>
    .tl-page {
        padding: 10px 0 30px;
    }

    .tl-heading {
        margin-bottom: 25px;
    }

    .tl-heading h3 {
        color: #172554;
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .tl-heading p {
        color: #64748b;
        margin: 0;
        font-size: 14px;
    }

    .tl-stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .tl-stat {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        padding: 19px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, .04);
    }

    .tl-stat-label {
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 9px;
    }

    .tl-stat-number {
        color: #172554;
        font-size: 27px;
        font-weight: 800;
    }

    .tl-stat-icon {
        float: right;
        width: 39px;
        height: 39px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        font-size: 18px;
    }

    .tl-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
        overflow: hidden;
    }

    .tl-card-header {
        padding: 21px 23px;
        border-bottom: 1px solid #e2e8f0;
    }

    .tl-card-header h5 {
        color: #172554;
        font-weight: 800;
        margin: 0 0 5px;
        font-size: 17px;
    }

    .tl-card-header p {
        color: #64748b;
        font-size: 13px;
        margin: 0;
    }

    .tl-filter {
        display: flex;
        gap: 10px;
        padding: 18px 23px;
        flex-wrap: wrap;
    }

    .tl-filter input,
    .tl-filter select {
        min-height: 42px;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        padding: 8px 12px;
        outline: none;
        font-size: 13px;
    }

    .tl-filter input {
        flex: 1;
        min-width: 220px;
    }

    .tl-filter input:focus,
    .tl-filter select:focus {
        border-color: #2563eb;
    }

    .tl-btn {
        border: 0;
        border-radius: 9px;
        padding: 10px 17px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        cursor: pointer;
    }

    .tl-btn-primary {
        background: #1d4ed8;
        color: #fff;
    }

    .tl-btn-reset {
        background: #f1f5f9;
        color: #475569;
    }

    .tl-table-wrap {
        overflow-x: auto;
    }

    .tl-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 950px;
    }

    .tl-table th {
        background: #f8fafc;
        color: #64748b;
        padding: 14px 16px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-weight: 800;
        text-align: left;
        white-space: nowrap;
    }

    .tl-table td {
        padding: 16px;
        border-top: 1px solid #f1f5f9;
        color: #334155;
        font-size: 13px;
        vertical-align: middle;
    }

    .tl-table tbody tr:hover {
        background: #f8fafc;
    }

    .tl-ticket {
        color: #1d4ed8;
        font-weight: 800;
    }

    .tl-main-text {
        color: #172554;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .tl-sub-text {
        color: #94a3b8;
        font-size: 12px;
    }

    .tl-status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .tl-diproses {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .tl-selesai {
        background: #dcfce7;
        color: #15803d;
    }

    .tl-ditolak {
        background: #fee2e2;
        color: #b91c1c;
    }

    .tl-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 7px 11px;
        border-radius: 8px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s;
    }

    .tl-action:hover {
        background: #1d4ed8;
        color: white;
    }

    .tl-empty {
        text-align: center;
        padding: 45px 20px !important;
        color: #94a3b8 !important;
    }

    .tl-pagination {
        padding: 18px 23px;
        border-top: 1px solid #e2e8f0;
    }

    .tl-alert {
        padding: 13px 16px;
        border-radius: 10px;
        margin-bottom: 18px;
        font-size: 13px;
    }

    @media(max-width: 900px) {
        .tl-stat-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width: 500px) {
        .tl-stat-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="tl-page">

    {{-- JUDUL HALAMAN --}}
    <div class="tl-heading">
        <h3>Data Tindak Lanjut</h3>
        <p>Kelola dan pantau seluruh riwayat penanganan pengaduan PMI.</p>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="tl-alert alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="tl-alert alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- STATISTIK --}}
    <div class="tl-stat-grid">

        <div class="tl-stat">
            <div class="tl-stat-icon" style="background:#dbeafe;color:#1d4ed8;">
                <i class="fas fa-history"></i>
            </div>
            <div class="tl-stat-label">Total Tindak Lanjut</div>
            <div class="tl-stat-number">{{ $totalTindaklanjut }}</div>
        </div>

        <div class="tl-stat">
            <div class="tl-stat-icon" style="background:#dbeafe;color:#2563eb;">
                <i class="fas fa-spinner"></i>
            </div>
            <div class="tl-stat-label">Sedang Diproses</div>
            <div class="tl-stat-number">{{ $totalDiproses }}</div>
        </div>

        <div class="tl-stat">
            <div class="tl-stat-icon" style="background:#dcfce7;color:#16a34a;">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="tl-stat-label">Selesai</div>
            <div class="tl-stat-number">{{ $totalSelesai }}</div>
        </div>

        <div class="tl-stat">
            <div class="tl-stat-icon" style="background:#fee2e2;color:#dc2626;">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="tl-stat-label">Ditolak</div>
            <div class="tl-stat-number">{{ $totalDitolak }}</div>
        </div>

    </div>

    {{-- TABEL DATA --}}
    <div class="tl-card">

        <div class="tl-card-header">
            <h5>Riwayat Tindak Lanjut Pengaduan</h5>
            <p>Daftar seluruh tindakan yang telah dilakukan oleh petugas.</p>
        </div>

        {{-- PENCARIAN DAN FILTER --}}
        <form action="{{ route('admin.tindaklanjut.index') }}" method="GET" class="tl-filter">

            <input
                type="text"
                name="cari"
                placeholder="Cari nomor tiket, judul, pengadu, atau petugas..."
                value="{{ request('cari') }}"
            >

            <select name="status">
                <option value="">Semua Status</option>
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

            <button type="submit" class="tl-btn tl-btn-primary">
                <i class="fas fa-search"></i> Cari
            </button>

            <a href="{{ route('admin.tindaklanjut.index') }}" class="tl-btn tl-btn-reset">
                Reset
            </a>

        </form>

        {{-- TABEL --}}
        <div class="tl-table-wrap">
            <table class="tl-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pengaduan</th>
                        <th>Nama Pengadu</th>
                        <th>Petugas</th>
                        <th>Keterangan Tindak Lanjut</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($data as $item)

                        <tr>
                            <td>
                                {{ $data->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <div class="tl-ticket">
                                    {{ $item->pengaduan->nomor_tiket ?? '-' }}
                                </div>
                                <div class="tl-sub-text">
                                    {{ $item->pengaduan->judul ?? 'Pengaduan tidak tersedia' }}
                                </div>
                            </td>

                            <td>
                                <div class="tl-main-text">
                                    {{ $item->pengaduan->pengadu->nama ?? '-' }}
                                </div>
                            </td>

                            <td>
                                {{ $item->petugas->nama ?? 'Belum ditentukan' }}
                            </td>

                            <td>
                                {{ \Illuminate\Support\Str::limit($item->keterangan, 65) }}
                            </td>

                            <td>
                                @if($item->status == 'diproses')
                                    <span class="tl-status tl-diproses">Diproses</span>
                                @elseif($item->status == 'selesai')
                                    <span class="tl-status tl-selesai">Selesai</span>
                                @elseif($item->status == 'ditolak')
                                    <span class="tl-status tl-ditolak">Ditolak</span>
                                @else
                                    <span class="tl-status">{{ ucfirst($item->status) }}</span>
                                @endif
                            </td>

                            <td>
                                {{ $item->tanggal ? $item->tanggal->format('d/m/Y H:i') : '-' }}
                            </td>

                            <td>
                                <a
                                    href="{{ route('admin.tindaklanjut.show', $item->idtindaklanjut) }}"
                                    class="tl-action"
                                >
                                    <i class="fas fa-eye"></i>
                                    Detail
                                </a>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="tl-empty">
                                <i class="fas fa-folder-open fa-2x mb-3"></i>
                                <div>Belum ada data tindak lanjut.</div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="tl-pagination">
            {{ $data->links() }}
        </div>

    </div>

</div>

@endsection
