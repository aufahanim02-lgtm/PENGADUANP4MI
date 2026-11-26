
@extends('layouts.appadmin')

@section('page-title', 'Edit Pengaduan')

@section('content')

<style>
    .form-pengaduan-page {
        padding: 20px 0;
    }

    .form-pengaduan-header {
        margin-bottom: 25px;
    }

    .form-pengaduan-header h3 {
        color: #1e293b;
        font-size: 25px;
        font-weight: 700;
    }

    .form-pengaduan-header p {
        color: #64748b;
    }

    .form-pengaduan-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 3px 10px rgba(0,0,0,.03);
    }

    .form-pengaduan-card label {
        color: #334155;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-pengaduan-card .form-control,
    .form-pengaduan-card .form-select {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 11px 13px;
    }

    .form-pengaduan-card .form-control:focus,
    .form-pengaduan-card .form-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,.1);
    }

    .btn-simpan-pengaduan {
        background: #2563eb;
        color: white;
        border: none;
        padding: 11px 20px;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-kembali-pengaduan {
        background: #e2e8f0;
        color: #334155;
        padding: 11px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
    }
</style>

<div class="form-pengaduan-page">

    <div class="form-pengaduan-header">
        <h3>Edit Pengaduan</h3>
        <p>Perbarui informasi pengaduan yang sudah tersimpan.</p>
    </div>

    <div class="form-pengaduan-card">

        <form action="{{ route('admin.pengaduan.update', $data->idpengaduan) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Nama Pengadu</label>
                    <select name="idpengadu" class="form-select">
                        <option value="">-- Pilih Pengadu --</option>

                        @foreach($pengadu as $item)
                            <option value="{{ $item->idpengadu }}"
                                {{ old('idpengadu', $data->idpengadu) == $item->idpengadu ? 'selected' : '' }}>
                                {{ $item->nama }} - {{ $item->nik }}
                            </option>
                        @endforeach
                    </select>
                    @error('idpengadu')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Kategori Pengaduan</label>
                    <select name="idkategori" class="form-select">
                        <option value="">-- Pilih Kategori --</option>

                        @foreach($kategori as $item)
                            <option value="{{ $item->idkategori }}"
                                {{ old('idkategori', $data->idkategori) == $item->idkategori ? 'selected' : '' }}>
                                {{ $item->namakategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('idkategori')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Wilayah</label>
                    <select name="idwilayah" class="form-select">
                        <option value="">-- Pilih Wilayah --</option>

                        @foreach($wilayah as $item)
                            <option value="{{ $item->idwilayah }}"
                                {{ old('idwilayah', $data->idwilayah) == $item->idwilayah ? 'selected' : '' }}>
                                {{ $item->provinsi }} - {{ $item->kabupaten }} - {{ $item->kecamatan }}
                            </option>
                        @endforeach
                    </select>
                    @error('idwilayah')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tanggal Pengaduan</label>
                    <input type="date"
                           name="tanggal"
                           class="form-control"
                           value="{{ old('tanggal', $data->tanggal ? $data->tanggal->format('Y-m-d') : '') }}">
                    @error('tanggal')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label>Judul Pengaduan</label>
                    <input type="text"
                           name="judul"
                           class="form-control"
                           value="{{ old('judul', $data->judul) }}"
                           placeholder="Masukkan judul pengaduan">
                    @error('judul')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label>Isi Pengaduan</label>
                    <textarea name="isi"
                              rows="5"
                              class="form-control"
                              placeholder="Tuliskan isi pengaduan">{{ old('isi', $data->isi) }}</textarea>
                    @error('isi')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label>Status Pengaduan</label>
                    <select name="status" class="form-select">
                        @foreach(['diajukan', 'diverifikasi', 'diproses', 'selesai', 'ditolak'] as $status)
                            <option value="{{ $status }}"
                                {{ old('status', $data->status) == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn-simpan-pengaduan">
                    Simpan Perubahan
                </button>

                <a href="{{ route('admin.pengaduan.index') }}"
                   class="btn-kembali-pengaduan">
                    Kembali
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
