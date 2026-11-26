@extends('layouts.appadmin')

@section('page-title', 'Tambah Kategori')

@section('content')

<style>
    .kategori-form-page {
        padding: 10px 0 30px;
    }

    .form-heading {
        margin-bottom: 25px;
    }

    .form-heading h3 {
        color: #172554;
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .form-heading p {
        color: #64748b;
        font-size: 14px;
        margin: 0;
    }

    .form-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .04);
    }

    .form-card-header {
        padding: 20px 25px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }

    .form-card-header h5 {
        color: #172554;
        font-size: 16px;
        font-weight: 800;
        margin: 0;
    }

    .form-card-body {
        padding: 25px;
    }

    .form-label {
        color: #334155;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select {
        min-height: 44px;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        font-size: 13px;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .12);
    }

    .required {
        color: #dc2626;
    }

    .form-text {
        font-size: 12px;
        color: #94a3b8;
    }

    .info-box {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 10px;
        padding: 14px 16px;
        color: #1e40af;
        font-size: 13px;
        margin-bottom: 22px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 10px;
        padding-top: 22px;
        margin-top: 25px;
        border-top: 1px solid #e2e8f0;
    }

    .btn-form {
        padding: 10px 19px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }

    .btn-cancel {
        background: #f1f5f9;
        color: #475569;
    }

    .btn-cancel:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    .btn-save {
        background: #2563eb;
        color: white;
    }

    .btn-save:hover {
        background: #1d4ed8;
        color: white;
    }

    @media(max-width: 576px) {
        .form-card-body {
            padding: 18px;
        }

        .form-heading h3 {
            font-size: 21px;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .form-actions .btn-form {
            justify-content: center;
            width: 100%;
        }
    }
</style>

<div class="kategori-form-page">

    {{-- HEADER --}}
    <div class="form-heading">
        <h3>Tambah Kategori</h3>
        <p>Tambahkan kategori baru untuk mengelompokkan pengaduan PMI.</p>
    </div>

    {{-- VALIDATION ERROR --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Periksa kembali data yang dimasukkan.</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- FORM --}}
    <div class="form-card">

        <div class="form-card-header">
            <h5>
                <i class="bi bi-tags me-2"></i>
                Formulir Kategori Pengaduan
            </h5>
        </div>

        <div class="form-card-body">

            <div class="info-box">
                <i class="bi bi-info-circle me-2"></i>
                Isi nama kategori dengan jelas agar memudahkan pengelompokan
                laporan pengaduan PMI.
            </div>

            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf

                {{-- NAMA KATEGORI --}}
                <div class="mb-4">
                    <label for="nama" class="form-label">
                        Nama Kategori <span class="required">*</span>
                    </label>

                    <input type="text"
                        name="nama"
                        id="nama"
                        class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama') }}"
                        placeholder="Contoh: Gaji Tidak Dibayar"
                        maxlength="100"
                        required>

                    @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="form-text">
                        Nama kategori maksimal 100 karakter dan tidak boleh sama.
                    </div>
                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-4">
                    <label for="deskripsi" class="form-label">
                        Deskripsi
                    </label>

                    <textarea name="deskripsi"
                        id="deskripsi"
                        class="form-control @error('deskripsi') is-invalid @enderror"
                        placeholder="Jelaskan jenis permasalahan yang termasuk dalam kategori ini...">{{ old('deskripsi') }}</textarea>

                    @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="form-text">
                        Deskripsi bersifat opsional.
                    </div>
                </div>

                {{-- STATUS --}}
                <div class="mb-4">
                    <label for="aktif" class="form-label">
                        Status Kategori <span class="required">*</span>
                    </label>

                    <select name="aktif"
                        id="aktif"
                        class="form-select @error('aktif') is-invalid @enderror"
                        required>

                        <option value="1" {{ old('aktif', '1') == '1' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="0" {{ old('aktif') == '0' ? 'selected' : '' }}>
                            Nonaktif
                        </option>

                    </select>

                    @error('aktif')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ACTION --}}
                <div class="form-actions">

                    <a href="{{ route('admin.kategori.index') }}"
                        class="btn-form btn-cancel">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit" class="btn-form btn-save">
                        <i class="bi bi-save"></i>
                        Simpan Kategori
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection