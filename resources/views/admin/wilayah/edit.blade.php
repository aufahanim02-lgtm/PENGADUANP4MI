@extends('layouts.appadmin')

@section('page-title', 'Edit Data Wilayah')

@section('content')

<style>
    .wilayah-form-page {
        padding: 10px 0 30px;
    }

    .form-heading {
        margin-bottom: 24px;
    }

    .form-heading h3 {
        color: #172554;
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .form-heading p {
        color: #64748b;
        margin: 0;
    }

    .form-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 28px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, .04);
    }

    .form-label {
        color: #334155;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        padding: 11px 13px;
        min-height: 45px;
    }

    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
    }

    .btn-simpan {
        background: #2563eb;
        color: white;
        border: none;
        border-radius: 9px;
        padding: 11px 20px;
        font-weight: 700;
    }

    .btn-simpan:hover {
        background: #1d4ed8;
        color: white;
    }

    .btn-kembali {
        background: #f1f5f9;
        color: #334155;
        border-radius: 9px;
        padding: 11px 20px;
        font-weight: 700;
        text-decoration: none;
    }

    .btn-kembali:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    .required {
        color: #dc2626;
    }
</style>

<div class="wilayah-form-page">

    <div class="form-heading">
        <h3>Edit Data Wilayah</h3>
        <p>Perbarui informasi wilayah yang sudah tersimpan.</p>
    </div>

    <div class="form-card">

        <form action="{{ route('admin.wilayah.update', $wilayah->idwilayah) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">
                        Provinsi <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="provinsi"
                        class="form-control @error('provinsi') is-invalid @enderror"
                        value="{{ old('provinsi', $wilayah->provinsi) }}"
                        required>

                    @error('provinsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        Kabupaten/Kota <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="kabupaten"
                        class="form-control @error('kabupaten') is-invalid @enderror"
                        value="{{ old('kabupaten', $wilayah->kabupaten) }}"
                        required>

                    @error('kabupaten')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Kecamatan</label>

                    <input
                        type="text"
                        name="kecamatan"
                        class="form-control @error('kecamatan') is-invalid @enderror"
                        value="{{ old('kecamatan', $wilayah->kecamatan) }}">

                    @error('kecamatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Desa/Kampung</label>

                    <input
                        type="text"
                        name="desa"
                        class="form-control @error('desa') is-invalid @enderror"
                        value="{{ old('desa', $wilayah->desa) }}">

                    @error('desa')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Status Wilayah</label>

                    <select name="aktif" class="form-control" required>
                        <option value="1" {{ old('aktif', $wilayah->aktif) == 1 ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="0" {{ old('aktif', $wilayah->aktif) == 0 ? 'selected' : '' }}>
                            Tidak Aktif
                        </option>
                    </select>
                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end gap-2 flex-wrap">

                <a href="{{ route('admin.wilayah.index') }}" class="btn-kembali">
                    Batal
                </a>

                <button type="submit" class="btn-simpan">
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>
</div>

@endsection