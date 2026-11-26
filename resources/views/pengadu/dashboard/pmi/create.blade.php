
@extends('layouts.apppengadu')

@section('page-title', 'Tambah Data PMI')

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
        margin-bottom: 7px;
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
        margin-bottom: 25px;
    }

    .form-card-header {
        padding: 18px 22px;
        border-bottom: 1px solid #e5e7eb;
        background: #f8fafc;
    }

    .form-card-header h5 {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .form-card-body {
        padding: 25px;
    }

    .form-label {
        font-weight: 600;
        font-size: 13px;
        color: #334155;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 13px;
        border-color: #dbe2ea;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #16a34a;
        box-shadow: 0 0 0 .2rem rgba(22, 163, 74, .10);
    }

    .required {
        color: #dc2626;
    }

    .form-note {
        color: #64748b;
        font-size: 12px;
        margin-top: 6px;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }

    @media(max-width: 576px) {
        .form-card-body {
            padding: 18px;
        }

        .form-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="form-header">
        <h4>
            <i class="bi bi-person-plus-fill me-2"></i>
            Tambah Data PMI
        </h4>

        <p>
            Lengkapi informasi Pekerja Migran Indonesia dengan benar.
        </p>
    </div>


    {{-- VALIDATION ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>
                <i class="bi bi-exclamation-triangle me-2"></i>
                Data belum berhasil disimpan!
            </strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    <form action="{{ route('pengadu.pmi.store') }}" method="POST">

        @csrf

        {{-- INFORMASI PRIBADI --}}
        <div class="form-card">

            <div class="form-card-header">
                <h5>
                    <i class="bi bi-person-vcard text-success me-2"></i>
                    Informasi Pribadi PMI
                </h5>
            </div>

            <div class="form-card-body">

                <div class="row g-3">

                    {{-- NAMA --}}
                    <div class="col-md-6">
                        <label class="form-label">
                            Nama Lengkap PMI <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="nama"
                               class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama') }}"
                               placeholder="Masukkan nama lengkap PMI"
                               maxlength="100"
                               required>

                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- NIK --}}
                    <div class="col-md-6">
                        <label class="form-label">NIK</label>

                        <input type="text"
                               name="nik"
                               class="form-control @error('nik') is-invalid @enderror"
                               value="{{ old('nik') }}"
                               placeholder="Masukkan 16 digit NIK"
                               maxlength="16"
                               inputmode="numeric">

                        @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="form-note">
                            NIK harus terdiri dari 16 digit.
                        </div>
                    </div>


                    {{-- JENIS KELAMIN --}}
                    <div class="col-md-6">
                        <label class="form-label">Jenis Kelamin</label>

                        <select name="jeniskelamin"
                                class="form-select @error('jeniskelamin') is-invalid @enderror">

                            <option value="">-- Pilih Jenis Kelamin --</option>

                            <option value="Laki-laki"
                                {{ old('jeniskelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki
                            </option>

                            <option value="Perempuan"
                                {{ old('jeniskelamin') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>

                        </select>

                        @error('jeniskelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- TANGGAL LAHIR --}}
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>

                        <input type="date"
                               name="tanggallahir"
                               class="form-control @error('tanggallahir') is-invalid @enderror"
                               value="{{ old('tanggallahir') }}"
                               max="{{ date('Y-m-d', strtotime('-1 day')) }}">

                        @error('tanggallahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- NO HP --}}
                    <div class="col-md-6">
                        <label class="form-label">Nomor HP</label>

                        <input type="text"
                               name="nohp"
                               class="form-control @error('nohp') is-invalid @enderror"
                               value="{{ old('nohp') }}"
                               placeholder="Contoh: 081234567890"
                               maxlength="20">

                        @error('nohp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

            </div>
        </div>


        {{-- INFORMASI PEKERJAAN --}}
        <div class="form-card">

            <div class="form-card-header">
                <h5>
                    <i class="bi bi-briefcase-fill text-success me-2"></i>
                    Informasi Pekerjaan
                </h5>
            </div>

            <div class="form-card-body">

                <div class="row g-3">

                    {{-- NEGARA --}}
                    <div class="col-md-6">
                        <label class="form-label">Negara Tujuan</label>

                        <input type="text"
                               name="negara"
                               class="form-control @error('negara') is-invalid @enderror"
                               value="{{ old('negara') }}"
                               placeholder="Contoh: Malaysia"
                               maxlength="100">

                        @error('negara')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- PERUSAHAAN --}}
                    <div class="col-md-6">
                        <label class="form-label">Nama Perusahaan</label>

                        <input type="text"
                               name="perusahaan"
                               class="form-control @error('perusahaan') is-invalid @enderror"
                               value="{{ old('perusahaan') }}"
                               placeholder="Masukkan nama perusahaan"
                               maxlength="150">

                        @error('perusahaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- ALAMAT KERJA --}}
                    <div class="col-md-12">
                        <label class="form-label">Alamat Tempat Kerja</label>

                        <textarea name="alamatkerja"
                                  class="form-control @error('alamatkerja') is-invalid @enderror"
                                  rows="4"
                                  placeholder="Masukkan alamat tempat kerja PMI">{{ old('alamatkerja') }}</textarea>

                        @error('alamatkerja')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- STATUS PMI --}}
                    <div class="col-md-6">
                        <label class="form-label">Status PMI</label>

                        <select name="statuspmi"
                                class="form-select @error('statuspmi') is-invalid @enderror">

                            <option value="">-- Pilih Status PMI --</option>

                            <option value="Aktif"
                                {{ old('statuspmi') == 'Aktif' ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value="Cuti"
                                {{ old('statuspmi') == 'Cuti' ? 'selected' : '' }}>
                                Cuti
                            </option>

                            <option value="Nonaktif"
                                {{ old('statuspmi') == 'Nonaktif' ? 'selected' : '' }}>
                                Nonaktif
                            </option>

                        </select>

                        @error('statuspmi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

            </div>
        </div>


        {{-- TOMBOL --}}
        <div class="form-actions mb-4">

            <a href="{{ route('pengadu.pmi.index') }}"
               class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>

            <button type="submit" class="btn btn-success px-4">
                <i class="bi bi-save me-1"></i>
                Simpan Data PMI
            </button>

        </div>

    </form>

</div>

@endsection
