@extends('layouts.appetugas')

@section('page-title', 'Tindak Lanjut Pengaduan')

@section('content')

<style>
    .tl-page {
        padding: 5px;
    }

    .tl-heading {
        margin-bottom: 22px;
    }

    .tl-heading h2 {
        font-size: 23px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
    }

    .tl-heading p {
        color: #64748b;
        font-size: 14px;
        margin: 0;
    }

    .tl-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .tl-card-header {
        padding: 18px 20px;
        border-bottom: 1px solid #e2e8f0;
    }

    .tl-card-header h3 {
        font-size: 17px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 5px;
    }

    .tl-card-header p {
        font-size: 13px;
        color: #64748b;
        margin: 0;
    }

    .tl-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        padding: 20px;
    }

    .tl-info span {
        display: block;
        color: #64748b;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .tl-info strong {
        color: #334155;
        font-size: 14px;
    }

    .tl-table-wrap {
        overflow-x: auto;
    }

    .tl-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 750px;
    }

    .tl-table th {
        background: #f8fafc;
        color: #475569;
        font-size: 12px;
        text-transform: uppercase;
        padding: 14px;
        text-align: left;
    }

    .tl-table td {
        padding: 14px;
        border-top: 1px solid #f1f5f9;
        color: #334155;
        font-size: 13px;
        vertical-align: middle;
    }

    .tl-table tr:hover {
        background: #fafcff;
    }

    .tl-status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
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

    .tl-actions {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .tl-btn {
        display: inline-block;
        padding: 7px 11px;
        border-radius: 7px;
        text-decoration: none;
        border: 0;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
    }

    .tl-detail {
        background: #eff6ff;
        color: #1d4ed8;
    }

    .tl-edit {
        background: #fef3c7;
        color: #92400e;
    }

    .tl-delete {
        background: #fee2e2;
        color: #b91c1c;
    }

    .tl-primary {
        background: #1d4ed8;
        color: white;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
    }

    .tl-empty {
        text-align: center;
        padding: 30px !important;
        color: #94a3b8 !important;
    }

    .tl-alert {
        padding: 13px 16px;
        border-radius: 8px;
        margin-bottom: 18px;
        font-size: 13px;
    }

    .tl-success {
        background: #dcfce7;
        color: #166534;
    }

    .tl-danger {
        background: #fee2e2;
        color: #991b1b;
    }

    .tl-pagination {
        padding: 17px;
    }

    @media(max-width: 650px) {
        .tl-info {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="tl-page">

    <div class="tl-heading">
        <h2>Tindak Lanjut Pengaduan</h2>
        <p>Kelola catatan perkembangan dan penanganan pengaduan.</p>
    </div>

    @if(session('success'))
    <div class="tl-alert tl-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="tl-alert tl-danger">{{ session('error') }}</div>
    @endif

    {{-- INFORMASI PENGADUAN --}}
    <div class="tl-card">
        <div class="tl-card-header">
            <h3>Informasi Pengaduan</h3>
            <p>Pengaduan yang sedang ditindaklanjuti.</p>
        </div>

        <div class="tl-info">
            <div>
                <span>Nomor Tiket</span>
                <strong>{{ $pengaduan->nomor_tiket ?? '-' }}</strong>
            </div>
            <div>
                <span>Judul Pengaduan</span>
                <strong>{{ $pengaduan->judul }}</strong>
            </div>
            <div>
                <span>Nama Pengadu</span>
                <strong>{{ $pengaduan->pengadu->nama ?? '-' }}</strong>
            </div>
            <div>
                <span>Status Pengaduan</span>
                <strong>{{ ucwords(str_replace('_', ' ', $pengaduan->status)) }}</strong>
            </div>
        </div>
    </div>

    {{-- DAFTAR TINDAK LANJUT --}}
    <div class="tl-card">
        <div class="tl-card-header">
            <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
                <div>
                    <h3>Riwayat Tindak Lanjut</h3>
                    <p>Daftar aktivitas penanganan pengaduan.</p>
                </div>

                <a href="{{ route('petugas.pengaduan.tindaklanjut.create', $pengaduan->idpengaduan) }}"
                    class="tl-primary">
                    + Tambah Tindak Lanjut
                </a>
            </div>
        </div>

        <div class="tl-table-wrap">
            <table class="tl-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Petugas</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                        <td>{{ $item->tanggal ? $item->tanggal->format('d-m-Y H:i') : '-' }}</td>
                        <td>{{ $item->petugas->nama ?? '-' }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($item->keterangan, 65) }}</td>
                        <td>
                            <span class="tl-status status-{{ $item->status }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="tl-actions">
                                <a href="{{ route('petugas.pengaduan.tindaklanjut.show', [$pengaduan->idpengaduan, $item->idtindaklanjut]) }}"
                                    class="tl-btn tl-detail">Detail</a>

                                <a href="{{ route('petugas.pengaduan.tindaklanjut.edit', [$pengaduan->idpengaduan, $item->idtindaklanjut]) }}"
                                    class="tl-btn tl-edit">Edit</a>

                                <form action="{{ route('petugas.pengaduan.tindaklanjut.destroy', [$pengaduan->idpengaduan, $item->idtindaklanjut]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus tindak lanjut ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="tl-btn tl-delete">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="tl-empty">
                            Belum ada catatan tindak lanjut untuk pengaduan ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="tl-pagination">
            {{ $data->links() }}
        </div>
    </div>

    <a href="{{ route('petugas.pengaduan.show', $pengaduan->idpengaduan) }}"
        style="color:#475569;text-decoration:none;font-size:13px;">
        ← Kembali ke Detail Pengaduan
    </a>

</div>

@endsection