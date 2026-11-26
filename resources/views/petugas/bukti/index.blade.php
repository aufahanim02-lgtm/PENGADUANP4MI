@extends('layouts.appetugas')

@section('page-title', 'Bukti Pengaduan')

@section('content')

<style>
    .bukti-page {
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
        font-size: 14px;
        margin: 0;
    }

    .bukti-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .card-heading {
        padding: 18px 20px;
        border-bottom: 1px solid #e2e8f0;
    }

    .card-heading h3 {
        font-size: 17px;
        color: #1e293b;
        font-weight: 700;
        margin: 0 0 5px;
    }

    .card-heading p {
        font-size: 13px;
        color: #64748b;
        margin: 0;
    }

    .card-body {
        padding: 20px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .info-item span {
        display: block;
        font-size: 12px;
        color: #64748b;
        margin-bottom: 5px;
    }

    .info-item strong {
        font-size: 14px;
        color: #334155;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 7px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 13px;
        box-sizing: border-box;
    }

    .form-group textarea {
        min-height: 90px;
        resize: vertical;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #2563eb;
    }

    .form-help {
        font-size: 12px;
        color: #64748b;
        margin-top: 7px;
    }

    .btn-upload {
        background: #1d4ed8;
        color: white;
        border: none;
        padding: 11px 18px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-upload:hover {
        background: #1e40af;
    }

    .btn-detail {
        display: inline-block;
        background: #eff6ff;
        color: #1d4ed8;
        text-decoration: none;
        padding: 7px 12px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-delete {
        background: #fee2e2;
        color: #b91c1c;
        border: none;
        padding: 7px 12px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .bukti-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 750px;
    }

    .bukti-table th {
        background: #f8fafc;
        color: #475569;
        font-size: 12px;
        text-transform: uppercase;
        padding: 14px;
        text-align: left;
    }

    .bukti-table td {
        padding: 14px;
        border-top: 1px solid #f1f5f9;
        color: #334155;
        font-size: 13px;
        vertical-align: middle;
    }

    .bukti-table tr:hover {
        background: #fafcff;
    }

    .file-name {
        font-weight: 600;
        color: #1e293b;
    }

    .alert {
        padding: 13px 16px;
        border-radius: 8px;
        margin-bottom: 18px;
        font-size: 13px;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
    }

    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
    }

    .alert-warning {
        background: #fef3c7;
        color: #92400e;
    }

    .empty-state {
        text-align: center;
        padding: 30px !important;
        color: #94a3b8 !important;
    }

    .pagination-wrapper {
        padding: 17px;
    }

    .back-link {
        display: inline-block;
        color: #475569;
        text-decoration: none;
        margin-bottom: 17px;
        font-size: 13px;
        font-weight: 600;
    }

    @media(max-width: 650px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="bukti-page">

    <a href="{{ route('petugas.pengaduan.show', $pengaduan->idpengaduan) }}"
        class="back-link">
        ← Kembali ke Detail Pengaduan
    </a>

    <div class="page-heading">
        <h2>Bukti Pengaduan</h2>
        <p>Kelola dokumen dan foto bukti pendukung pengaduan.</p>
    </div>

    {{-- PESAN --}}
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <strong>Periksa kembali data yang dimasukkan:</strong>
        <ul style="margin:8px 0 0;padding-left:20px;">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- INFORMASI PENGADUAN --}}
    <div class="bukti-card">
        <div class="card-heading">
            <h3>Informasi Pengaduan</h3>
            <p>Pengaduan yang memiliki dokumen bukti pendukung.</p>
        </div>

        <div class="card-body">
            <div class="info-grid">
                <div class="info-item">
                    <span>Nomor Tiket</span>
                    <strong>{{ $pengaduan->nomor_tiket ?? '-' }}</strong>
                </div>

                <div class="info-item">
                    <span>Judul Pengaduan</span>
                    <strong>{{ $pengaduan->judul }}</strong>
                </div>

                <div class="info-item">
                    <span>Nama Pengadu</span>
                    <strong>{{ $pengaduan->pengadu->nama ?? '-' }}</strong>
                </div>

                <div class="info-item">
                    <span>Status Pengaduan</span>
                    <strong>{{ ucwords(str_replace('_', ' ', $pengaduan->status)) }}</strong>
                </div>
            </div>
        </div>
    </div>

    {{-- FORM UPLOAD --}}
    <div class="bukti-card">
        <div class="card-heading">
            <h3>Unggah Bukti Baru</h3>
            <p>Pilih foto atau dokumen yang berkaitan dengan pengaduan ini.</p>
        </div>

        <div class="card-body">
            <form action="{{ route('petugas.pengaduan.bukti.store', $pengaduan->idpengaduan) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label for="file">Pilih File Bukti <span style="color:red;">*</span></label>
                    <input type="file"
                        name="file"
                        id="file"
                        accept=".jpg,.jpeg,.png,.pdf,.doc,.docx"
                        required>

                    <div class="form-help">
                        Format JPG, JPEG, PNG, PDF, DOC, DOCX. Maksimal 5 MB.
                    </div>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan Bukti</label>
                    <textarea name="keterangan"
                        id="keterangan"
                        placeholder="Masukkan keterangan mengenai bukti...">{{ old('keterangan') }}</textarea>
                </div>

                <button type="submit" class="btn-upload">
                    + Unggah Bukti
                </button>

            </form>
        </div>
    </div>

    {{-- DAFTAR BUKTI --}}
    <div class="bukti-card">

        <div class="card-heading">
            <h3>Daftar File Bukti</h3>
            <p>Seluruh bukti yang sudah tersimpan untuk pengaduan ini.</p>
        </div>

        <div class="table-responsive">
            <table class="bukti-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama File</th>
                        <th>Jenis File</th>
                        <th>Ukuran</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($bukti as $item)
                    <tr>
                        <td>
                            {{ $loop->iteration + ($bukti->currentPage() - 1) * $bukti->perPage() }}
                        </td>

                        <td>
                            <span class="file-name">
                                {{ $item->namafile }}
                            </span>
                        </td>

                        <td>{{ strtoupper(pathinfo($item->namafile, PATHINFO_EXTENSION)) }}</td>

                        <td>
                            {{ $item->ukuranfile ? number_format($item->ukuranfile / 1024, 2) . ' KB' : '-' }}
                        </td>

                        <td>{{ $item->keterangan ?: '-' }}</td>

                        <td>
                            <a href="{{ route('petugas.pengaduan.bukti.show', [$pengaduan->idpengaduan, $item->idbukti]) }}"
                                class="btn-detail">
                                Detail
                            </a>

                            <form action="{{ route('petugas.pengaduan.bukti.destroy', [$pengaduan->idpengaduan, $item->idbukti]) }}"
                                method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Yakin ingin menghapus bukti ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-delete">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            Belum ada bukti yang diunggah untuk pengaduan ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $bukti->links() }}
        </div>

    </div>

</div>

@endsection