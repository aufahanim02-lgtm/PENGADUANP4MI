@extends('layouts.appetugas')

@section('page-title', 'Detail Bukti Pengaduan')

@section('content')

<style>
    .detail-page {
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

    .back-link {
        display: inline-block;
        margin-bottom: 17px;
        color: #475569;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
    }

    .detail-card {
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
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .card-body {
        padding: 20px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .info-item span {
        display: block;
        color: #64748b;
        font-size: 12px;
        margin-bottom: 6px;
    }

    .info-item strong {
        color: #334155;
        font-size: 14px;
        overflow-wrap: anywhere;
    }

    .file-preview {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 10px;
        padding: 25px;
        text-align: center;
    }

    .file-icon {
        font-size: 48px;
        margin-bottom: 12px;
    }

    .file-preview h4 {
        color: #1e293b;
        font-size: 16px;
        margin-bottom: 7px;
        overflow-wrap: anywhere;
    }

    .file-preview p {
        color: #64748b;
        font-size: 13px;
        margin-bottom: 17px;
    }

    .btn-file {
        display: inline-block;
        background: #1d4ed8;
        color: #fff;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        margin: 4px;
    }

    .btn-file:hover {
        background: #1e40af;
        color: #fff;
    }

    .btn-download {
        background: #0f766e;
    }

    .btn-download:hover {
        background: #115e59;
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

    .form-group textarea {
        width: 100%;
        min-height: 110px;
        padding: 12px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 13px;
        resize: vertical;
        box-sizing: border-box;
    }

    .form-group textarea:focus {
        outline: none;
        border-color: #2563eb;
    }

    .btn-save {
        background: #1d4ed8;
        color: #fff;
        border: none;
        padding: 11px 18px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-save:hover {
        background: #1e40af;
    }

    .alert {
        padding: 13px 16px;
        border-radius: 8px;
        margin-bottom: 18px;
        font-size: 13px;
    }

    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
    }

    @media(max-width: 650px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="detail-page">

    {{-- KEMBALI --}}
    <a href="{{ route('petugas.pengaduan.bukti.index', $pengaduan->idpengaduan) }}"
        class="back-link">
        ← Kembali ke Daftar Bukti
    </a>

    {{-- JUDUL --}}
    <div class="page-heading">
        <h2>Detail Bukti Pengaduan</h2>
        <p>Informasi lengkap dokumen bukti pengaduan.</p>
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
        @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif

    {{-- INFORMASI PENGADUAN --}}
    <div class="detail-card">
        <div class="card-heading">
            <h3>Informasi Pengaduan</h3>
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
                    <strong>
                        {{ ucwords(str_replace('_', ' ', $pengaduan->status)) }}
                    </strong>
                </div>

            </div>
        </div>
    </div>

    {{-- DETAIL FILE --}}
    <div class="detail-card">
        <div class="card-heading">
            <h3>Informasi File Bukti</h3>
        </div>

        <div class="card-body">

            <div class="info-grid" style="margin-bottom:25px;">

                <div class="info-item">
                    <span>Nama File</span>
                    <strong>{{ $bukti->namafile }}</strong>
                </div>

                <div class="info-item">
                    <span>Jenis File</span>
                    <strong>{{ $bukti->jenisfile ?? '-' }}</strong>
                </div>

                <div class="info-item">
                    <span>Ukuran File</span>
                    <strong>
                        {{ $bukti->ukuranfile ? number_format($bukti->ukuranfile / 1024, 2) . ' KB' : '-' }}
                    </strong>
                </div>

                <div class="info-item">
                    <span>Tanggal Upload</span>
                    <strong>
                        {{ $bukti->created_at ? $bukti->created_at->format('d-m-Y H:i') : '-' }}
                    </strong>
                </div>

            </div>

            {{-- PREVIEW FILE --}}
            <div class="file-preview">

                @php
                $extension = strtolower(pathinfo($bukti->namafile, PATHINFO_EXTENSION));
                @endphp

                <div class="file-icon">
                    @if(in_array($extension, ['jpg', 'jpeg', 'png']))
                    🖼️
                    @elseif($extension === 'pdf')
                    📕
                    @else
                    📄
                    @endif
                </div>

                <h4>{{ $bukti->namafile }}</h4>

                <p>
                    {{ strtoupper($extension) }} ·
                    {{ $bukti->ukuranfile ? number_format($bukti->ukuranfile / 1024, 2) . ' KB' : 'Ukuran tidak tersedia' }}
                </p>

                @if(Storage::disk('public')->exists($bukti->pathfile))

                <a href="{{ asset('storage/' . $bukti->pathfile) }}"
                    target="_blank"
                    class="btn-file">
                    Lihat File
                </a>

                <a href="{{ asset('storage/' . $bukti->pathfile) }}"
                    download="{{ $bukti->namafile }}"
                    class="btn-file btn-download">
                    Unduh File
                </a>

                @else

                <p style="color:#dc2626;">
                    File tidak ditemukan di penyimpanan.
                </p>

                @endif

            </div>

        </div>
    </div>

    {{-- EDIT KETERANGAN --}}
    <div class="detail-card">
        <div class="card-heading">
            <h3>Perbarui Keterangan Bukti</h3>
        </div>

        <div class="card-body">

            <form action="{{ route('petugas.pengaduan.bukti.update', [
                    $pengaduan->idpengaduan,
                    $bukti->idbukti
                ]) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="keterangan">Keterangan Bukti</label>

                    <textarea name="keterangan"
                        id="keterangan"
                        placeholder="Masukkan keterangan bukti...">{{ old('keterangan', $bukti->keterangan) }}</textarea>
                </div>

                <button type="submit" class="btn-save">
                    Simpan Perubahan
                </button>

            </form>

        </div>
    </div>

</div>

@endsection