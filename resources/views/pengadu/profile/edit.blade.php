
@extends('layouts.apppengadu')

@section('title', 'Profil Saya')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="fw-bold mb-1">
            <i class="bi bi-person-circle text-primary me-2"></i>
            Profil Saya
        </h3>
        <p class="text-muted mb-0">
            Kelola informasi akun dan data pribadi Anda.
        </p>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- VALIDATION ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data yang dimasukkan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">

        {{-- INFORMASI PROFIL --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">

                    <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width: 100px; height: 100px;">

                        <span class="text-primary fw-bold"
                              style="font-size: 40px;">
                            {{ strtoupper(substr($pengadu->nama ?? 'P', 0, 1)) }}
                        </span>

                    </div>

                    <h5 class="fw-bold mb-1">
                        {{ $pengadu->nama }}
                    </h5>

                    <p class="text-muted mb-3">
                        Akun Pengadu
                    </p>

                    <hr>

                    <div class="text-start">
                        <p class="text-muted small mb-1">Username</p>
                        <p class="fw-semibold">
                            {{ $pengadu->username }}
                        </p>

                        <p class="text-muted small mb-1">Nomor Induk Kependudukan</p>
                        <p class="fw-semibold">
                            {{ $pengadu->nik }}
                        </p>

                        <p class="text-muted small mb-1">Bergabung Sejak</p>
                        <p class="fw-semibold mb-0">
                            {{ $pengadu->created_at?->format('d-m-Y') ?? '-' }}
                        </p>
                    </div>

                </div>
            </div>

        </div>

        {{-- FORM EDIT PROFIL --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-pencil-square text-primary me-2"></i>
                        Edit Informasi Profil
                    </h5>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('pengadu.profil.update') }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        {{-- NAMA --}}
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="nama"
                                   id="nama"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   value="{{ old('nama', $pengadu->nama) }}"
                                   maxlength="100"
                                   required>

                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NIK --}}
                        <div class="mb-3">
                            <label for="nik" class="form-label fw-semibold">
                                NIK
                            </label>

                            <input type="text"
                                   name="nik"
                                   id="nik"
                                   class="form-control @error('nik') is-invalid @enderror"
                                   value="{{ old('nik', $pengadu->nik) }}"
                                   maxlength="20">

                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NOMOR HP --}}
                        <div class="mb-3">
                            <label for="nohp" class="form-label fw-semibold">
                                Nomor HP <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="nohp"
                                   id="nohp"
                                   class="form-control @error('nohp') is-invalid @enderror"
                                   value="{{ old('nohp', $pengadu->nohp) }}"
                                   maxlength="20"
                                   required>

                            @error('nohp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ALAMAT --}}
                        <div class="mb-3">
                            <label for="alamat" class="form-label fw-semibold">
                                Alamat <span class="text-danger">*</span>
                            </label>

                            <textarea name="alamat"
                                      id="alamat"
                                      rows="4"
                                      class="form-control @error('alamat') is-invalid @enderror"
                                      required>{{ old('alamat', $pengadu->alamat) }}</textarea>

                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- USERNAME --}}
                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">
                                Username <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="username"
                                   id="username"
                                   class="form-control @error('username') is-invalid @enderror"
                                   value="{{ old('username', $pengadu->username) }}"
                                   maxlength="50"
                                   required>

                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        {{-- PASSWORD --}}
                        <h6 class="fw-bold mb-3">
                            <i class="bi bi-shield-lock text-primary me-2"></i>
                            Ganti Password
                        </h6>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">
                                Password Baru
                            </label>

                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Kosongkan jika tidak ingin mengganti password">

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <small class="text-muted">
                                Isi hanya jika ingin mengganti password akun.
                            </small>
                        </div>

                        {{-- TOMBOL --}}
                        <div class="d-flex justify-content-end gap-2 flex-wrap">

                            <a href="{{ route('pengadu.dashboard') }}"
                               class="btn btn-light border">
                                <i class="bi bi-arrow-left me-1"></i>
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i>
                                Simpan Perubahan
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>

</div>

@endsection
