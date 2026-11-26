@extends('layouts.apppengadu')

@section('page-title', 'Buat Pengaduan')

@section('content')

<style>
    .form-header {
        background: linear-gradient(135deg, #14532d, #166534);
        color: white;
        padding: 25px;
        border-radius: 15px;
        margin-bottom: 25px;
    }

    .form-header h4 {
        font-weight: 700;
        margin-bottom: 8px;
    }

    .form-header p {
        margin: 0;
        opacity: .85;
    }

    .form-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 22px;
    }

    .form-card-header {
        padding: 18px 22px;
        border-bottom: 1px solid #e5e7eb;
        background: #f8fafc;
    }

    .form-card-header h5 {
        margin: 0;
        color: #1e293b;
        font-weight: 700;
        font-size: 16px;
    }

    .form-card-body {
        padding: 25px;
    }

    .form-label {
        color: #334155;
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 13px;
        border-color: #dbe1e8;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #16a34a;
        box-shadow: 0 0 0 .2rem rgba(22, 163, 74, .12);
    }

    .required {
        color: #dc2626;
    }

    .form-info {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
        padding: 14px 16px;
        border-radius: 9px;
        font-size: 13px;
        margin-bottom: 22px;
    }

    .form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding: 18px 22px;
        border-top: 1px solid #e5e7eb;
    }

    @media (max-width: 768px) {
        .form-header {
            padding: 20px;
        }

        .form-card-body {
            padding: 18px;
        }
    }
</style>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="form-header">
        <h4>
            <i class="bi bi-file-earmark-plus me-2"></i>
            Buat Pengaduan Baru
        </h4>

        <p>
            Isi formulir berikut dengan informasi kejadian yang ingin Anda adukan.
        </p>
    </div>

    {{-- NOTIFIKASI VALIDASI --}}
    @if($errors->any())
    <div class="alert alert-danger">
        <div class="fw-bold mb-2">
            <i class="bi bi-exclamation-circle me-2"></i>
            Terdapat kesalahan pada pengisian formulir:
        </div>

        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- INFORMASI --}}
    <div class="form-info">
        <i class="bi bi-info-circle-fill me-2"></i>
        Pastikan informasi yang Anda masukkan benar dan sesuai dengan kejadian sebenarnya.
        Data pengaduan akan diteruskan kepada petugas untuk diverifikasi.
    </div>

    <form action="{{ route('pengadu.pengaduan.store') }}" method="POST">
        @csrf

        {{-- DATA PENGADUAN --}}
        <div class="form-card">

            <div class="form-card-header">
                <h5>
                    <i class="bi bi-file-text me-2 text-success"></i>
                    Informasi Pengaduan
                </h5>
            </div>

            <div class="form-card-body">

                <div class="row g-3">

                    {{-- DATA PMI --}}
                    <div class="col-md-6">
                        <label class="form-label">
                            Data PMI <span class="required">*</span>
                        </label>

                        <select name="idpmi"
                            class="form-select @error('idpmi') is-invalid @enderror"
                            required>

                            <option value="">-- Pilih Data PMI --</option>

                            @foreach($pmi as $item)
                            <option value="{{ $item->idpmi }}"
                                {{ old('idpmi') == $item->idpmi ? 'selected' : '' }}>
                                {{ $item->nama }} - {{ $item->nik ?? 'NIK belum tersedia' }}
                            </option>
                            @endforeach

                        </select>

                        @error('idpmi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KATEGORI --}}
                    <div class="col-md-6">
                        <label class="form-label">
                            Kategori Pengaduan <span class="required">*</span>
                        </label>

                        <select name="idkategori"
                            class="form-select @error('idkategori') is-invalid @enderror"
                            required>

                            <option value="">-- Pilih Kategori --</option>

                            @foreach($kategori as $item)
                            <option value="{{ $item->idkategori }}"
                                {{ old('idkategori') == $item->idkategori ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                            @endforeach

                        </select>

                        @error('idkategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- WILAYAH --}}
                    <div class="col-md-6">
                        <label class="form-label">
                            Wilayah <span class="required">*</span>
                        </label>

                        <select name="idwilayah"
                            class="form-select @error('idwilayah') is-invalid @enderror"
                            required>

                            <option value="">-- Pilih Wilayah --</option>

                            @foreach($wilayah as $item)
                            <option value="{{ $item->idwilayah }}"
                                {{ old('idwilayah') == $item->idwilayah ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                            @endforeach

                        </select>

                        @error('idwilayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- JUDUL --}}
                    <div class="col-md-6">
                        <label class="form-label">
                            Judul Pengaduan <span class="required">*</span>
                        </label>

                        <input type="text"
                            name="judul"
                            class="form-control @error('judul') is-invalid @enderror"
                            placeholder="Masukkan judul pengaduan"
                            value="{{ old('judul') }}"
                            maxlength="150"
                            required>

                        @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

            </div>
        </div>

        {{-- KRONOLOGI KEJADIAN --}}
        <div class="form-card">

            <div class="form-card-header">
                <h5>
                    <i class="bi bi-journal-text me-2 text-success"></i>
                    Kronologi dan Informasi Kejadian
                </h5>
            </div>

            <div class="form-card-body">

                <div class="row g-3">

                    {{-- TANGGAL KEJADIAN --}}
                    <div class="col-md-6">
                        <label class="form-label">
                            Tanggal Kejadian <span class="required">*</span>
                        </label>

                        <input type="date"
                            name="tanggalkejadian"
                            class="form-control @error('tanggalkejadian') is-invalid @enderror"
                            value="{{ old('tanggalkejadian') }}"
                            max="{{ date('Y-m-d') }}"
                            required>

                        @error('tanggalkejadian')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- LOKASI KEJADIAN --}}
                    <div class="col-md-6">
                        <label class="form-label">
                            Lokasi Kejadian <span class="required">*</span>
                        </label>

                        <input type="text"
                            name="lokasikejadian"
                            class="form-control @error('lokasikejadian') is-invalid @enderror"
                            placeholder="Contoh: Kuala Lumpur, Malaysia"
                            value="{{ old('lokasikejadian') }}"
                            maxlength="255"
                            required>

                        @error('lokasikejadian')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KRONOLOGI --}}
                    <div class="col-12">
                        <label class="form-label">
                            Kronologi Pengaduan <span class="required">*</span>
                        </label>

                        <textarea name="kronologi"
                            rows="7"
                            class="form-control @error('kronologi') is-invalid @enderror"
                            placeholder="Ceritakan kronologi kejadian secara lengkap, mulai dari awal kejadian hingga kondisi saat ini..."
                            required>{{ old('kronologi') }}</textarea>

                        @error('kronologi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <small class="text-muted">
                            Jelaskan kejadian secara jelas, lengkap, dan sesuai fakta.
                        </small>
                    </div>

                </div>

            </div>
        </div>

        {{-- TOMBOL --}}
        <div class="form-card">

            <div class="form-footer">

                <a href="{{ route('pengadu.pengaduan.index') }}"
                    class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                </a>

                <button type="submit" class="btn btn-success px-4">
                    <i class="bi bi-send-fill me-1"></i>
                    Kirim Pengaduan
                </button>

            </div>

        </div>

    </form>

</div>

@endsection