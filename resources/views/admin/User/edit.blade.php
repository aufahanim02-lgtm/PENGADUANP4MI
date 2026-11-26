@extends('layouts.appadmin')

@section('page-title', 'Edit User')

@section('content')

<style>
    .user-form-page {
        padding: 10px 0 30px;
        color: #1e293b;
    }

    .form-heading {
        margin-bottom: 22px;
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
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 13px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .035);
        overflow: hidden;
        max-width: 900px;
    }

    .form-card-header {
        padding: 20px 24px;
        background: #eff6ff;
        border-bottom: 1px solid #dbeafe;
    }

    .form-card-header h5 {
        color: #1e40af;
        font-size: 16px;
        font-weight: 800;
        margin: 0 0 5px;
    }

    .form-card-header p {
        color: #64748b;
        font-size: 12px;
        margin: 0;
    }

    .form-card-body {
        padding: 25px;
    }

    .form-section-title {
        color: #1e40af;
        font-size: 14px;
        font-weight: 800;
        padding-bottom: 12px;
        margin: 0 0 20px;
        border-bottom: 1px solid #e2e8f0;
    }

    .form-group {
        margin-bottom: 19px;
    }

    .form-group label {
        display: block;
        color: #334155;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .form-group label span {
        color: #dc2626;
    }

    .form-group .form-control,
    .form-group .form-select {
        min-height: 43px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 13px;
        box-shadow: none;
    }

    .form-group .form-control:focus,
    .form-group .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .1);
    }

    .form-group .form-text {
        color: #94a3b8;
        font-size: 11px;
        margin-top: 6px;
    }

    .form-group .is-invalid {
        border-color: #dc2626;
    }

    .invalid-feedback {
        font-size: 12px;
    }

    .form-info {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        color: #1e40af;
        border-radius: 9px;
        padding: 13px 15px;
        font-size: 12px;
        margin-bottom: 22px;
    }

    .form-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 20px;
        margin-top: 10px;
        border-top: 1px solid #e2e8f0;
    }

    .btn-save-user,
    .btn-cancel-user {
        min-height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 0 19px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .btn-save-user {
        background: #2563eb;
        color: white;
    }

    .btn-save-user:hover {
        background: #1d4ed8;
        color: white;
    }

    .btn-cancel-user {
        background: white;
        color: #475569;
        border: 1px solid #cbd5e1;
    }

    .btn-cancel-user:hover {
        background: #f1f5f9;
        color: #1e293b;
    }

    @media (max-width: 576px) {
        .form-card-body {
            padding: 18px;
        }

        .form-card-header {
            padding: 18px;
        }

        .form-footer {
            flex-direction: column-reverse;
        }

        .form-footer a,
        .form-footer button {
            width: 100%;
        }
    }
</style>

<div class="user-form-page">

    {{-- JUDUL --}}
    <div class="form-heading">
        <h3>Edit User</h3>
        <p>Perbarui informasi akun Administrator atau Petugas.</p>
    </div>

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Periksa kembali data yang kamu masukkan.</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="form-card">

        <div class="form-card-header">
            <h5>Formulir Edit User</h5>
            <p>Ubah informasi akun sesuai kebutuhan.</p>
        </div>

        <div class="form-card-body">

            <div class="form-info">
                <i class="bi bi-info-circle"></i>
                Kosongkan password jika tidak ingin mengganti password lama.
            </div>

            <form action="{{ route('admin.user.update', $user->iduser) }}"
                method="POST">

                @csrf
                @method('PUT')

                {{-- INFORMASI USER --}}
                <h6 class="form-section-title">
                    <i class="bi bi-person-circle"></i>
                    Informasi User
                </h6>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">
                                Nama Lengkap <span>*</span>
                            </label>

                            <input
                                type="text"
                                name="nama"
                                id="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $user->nama) }}"
                                maxlength="100"
                                required>

                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">
                                Username <span>*</span>
                            </label>

                            <input
                                type="text"
                                name="username"
                                id="username"
                                class="form-control @error('username') is-invalid @enderror"
                                value="{{ old('username', $user->username) }}"
                                maxlength="50"
                                required>

                            @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                {{-- PASSWORD --}}
                <h6 class="form-section-title mt-3">
                    <i class="bi bi-shield-lock"></i>
                    Ubah Password
                </h6>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password Baru</label>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Kosongkan jika tidak diganti"
                                minlength="8">

                            <div class="form-text">
                                Isi hanya jika ingin mengganti password. Minimal 8 karakter.
                            </div>

                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation">
                                Konfirmasi Password Baru
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control"
                                placeholder="Ulangi password baru"
                                minlength="8">
                        </div>
                    </div>

                </div>

                {{-- ROLE DAN STATUS --}}
                <h6 class="form-section-title mt-3">
                    <i class="bi bi-person-badge"></i>
                    Hak Akses dan Status Akun
                </h6>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role">
                                Role User <span>*</span>
                            </label>

                            <select
                                name="role"
                                id="role"
                                class="form-select @error('role') is-invalid @enderror"
                                required>
                                <option value="">-- Pilih Role --</option>

                                <option value="admin"
                                    {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                    Administrator
                                </option>

                                <option value="petugas"
                                    {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>
                                    Petugas
                                </option>
                            </select>

                            @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="aktif">
                                Status Akun <span>*</span>
                            </label>

                            <select
                                name="aktif"
                                id="aktif"
                                class="form-select @error('aktif') is-invalid @enderror"
                                required>
                                <option value="1"
                                    {{ old('aktif', $user->aktif ? '1' : '0') == '1' ? 'selected' : '' }}>
                                    Aktif
                                </option>

                                <option value="0"
                                    {{ old('aktif', $user->aktif ? '1' : '0') == '0' ? 'selected' : '' }}>
                                    Nonaktif
                                </option>
                            </select>

                            @error('aktif')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if (auth('user')->id() == $user->iduser)
                            <div class="form-text text-danger">
                                Akun yang sedang digunakan tidak dapat dinonaktifkan.
                            </div>
                            @endif
                        </div>
                    </div>

                </div>

                {{-- TOMBOL --}}
                <div class="form-footer">

                    <a href="{{ route('admin.user.index') }}"
                        class="btn-cancel-user">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit" class="btn-save-user">
                        <i class="bi bi-save"></i>
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection