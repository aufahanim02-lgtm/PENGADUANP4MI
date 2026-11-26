@extends('layouts.apppengadu')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <a href="{{ route('pengadu.pmi.index') }}"
            class="text-decoration-none text-muted small">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Data PMI
        </a>

        <h4 class="fw-bold mt-2 mb-1">Tambah Data PMI</h4>
        <p class="text-muted mb-0">
            Lengkapi formulir berikut untuk menambahkan data PMI.
        </p>
    </div>

    {{-- VALIDATION ERROR --}}
    @if($errors->any())
    <div class="alert alert-danger">
        <strong>Periksa kembali data yang kamu masukkan:</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">
                <i class="bi bi-person-plus me-2 text-primary"></i>
                Formulir Data PMI
            </h5>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('pengadu.pmi.store') }}" method="POST">
                @csrf

                <div class="row g-3">

                    {{-- NAMA --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Nama Lengkap PMI <span class="text-danger">*</span>
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
                        <label class="form-label fw-semibold">NIK</label>
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
                    </div>

                    {{-- JENIS KELAMIN --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                        <select name="jeniskelamin"
                            class="form-select @error('jeniskelamin') is-invalid @enderror">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki" {{ old('jeniskelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="Perempuan" {{ old('jeniskelamin') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                        @error('jeniskelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TANGGAL LAHIR --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                        <input type="date"
                            name="tanggallahir"
                            class="form-control @error('tanggallahir') is-invalid @enderror"
                            value="{{ old('tanggallahir') }}"
                            max="{{ date('Y-m-d') }}">
                        @error('tanggallahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NOMOR HP --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nomor HP</label>
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

                    {{-- NEGARA --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Negara Penempatan</label>
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
                        <label class="form-label fw-semibold">Nama Perusahaan</label>
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

                    {{-- STATUS PMI --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Status PMI</label>
                        <input type="text"
                            name="statuspmi"
                            class="form-control @error('statuspmi') is-invalid @enderror"
                            value="{{ old('statuspmi') }}"
                            placeholder="Contoh: Aktif"
                            maxlength="50">
                        @error('statuspmi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- ALAMAT KERJA --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">Alamat Tempat Kerja</label>
                        <textarea name="alamatkerja"
                            rows="3"
                            class="form-control @error('alamatkerja') is-invalid @enderror"
                            placeholder="Masukkan alamat tempat kerja PMI">{{ old('alamatkerja') }}</textarea>
                        @error('alamatkerja')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('pengadu.pmi.index') }}"
                        class="btn btn-light border">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection