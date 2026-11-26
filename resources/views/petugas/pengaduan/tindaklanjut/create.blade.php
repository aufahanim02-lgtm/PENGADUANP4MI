@extends('layouts.appetugas')

@section('page-title', 'Tambah Tindak Lanjut')

@section('content')

<style>
    .form-page {
        max-width: 850px;
        padding: 5px;
    }

    .form-heading {
        margin-bottom: 22px;
    }

    .form-heading h2 {
        font-size: 23px;
        font-weight: 700;
        color: #1e293b;
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
        border-radius: 12px;
        overflow: hidden;
    }

    .form-card-header {
        padding: 18px 20px;
        border-bottom: 1px solid #e2e8f0;
    }

    .form-card-header h3 {
        margin: 0;
        font-size: 17px;
        color: #1e293b;
    }

    .form-body {
        padding: 22px;
    }

    .form-group {
        margin-bottom: 19px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
    }

    .form-group textarea,
    .form-group select {
        width: 100%;
        box-sizing: border-box;
        padding: 12px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 13px;
    }

    .form-group textarea {
        min-height: 150px;
        resize: vertical;
    }

    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: #2563eb;
    }

    .form-help {
        color: #64748b;
        font-size: 12px;
        margin-top: 7px;
    }

    .form-error {
        color: #dc2626;
        font-size: 12px;
        margin-top: 6px;
    }

    .btn-save {
        background: #1d4ed8;
        color: white;
        border: 0;
        border-radius: 8px;
        padding: 11px 18px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-back {
        display: inline-block;
        background: #f1f5f9;
        color: #334155;
        text-decoration: none;
        border-radius: 8px;
        padding: 11px 18px;
        font-size: 13px;
    }

    .form-actions {
        display: flex;
        gap: 9px;
        flex-wrap: wrap;
    }

    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        padding: 13px;
        border-radius: 8px;
        margin-bottom: 17px;
        font-size: 13px;
    }
</style>

<div class="form-page">

    <div class="form-heading">
        <h2>Tambah Tindak Lanjut</h2>
        <p>Catat perkembangan penanganan pengaduan.</p>
    </div>

    @if($errors->any())
    <div class="alert-error">
        <strong>Periksa kembali data berikut:</strong>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="form-card">
        <div class="form-card-header">
            <h3>Formulir Tindak Lanjut</h3>
        </div>

        <div class="form-body">

            <div style="background:#f8fafc;padding:14px;border-radius:8px;margin-bottom:20px;">
                <div style="font-size:12px;color:#64748b;">Nomor Tiket</div>
                <strong>{{ $pengaduan->nomor_tiket ?? '-' }}</strong>
                <div style="font-size:13px;color:#475569;margin-top:5px;">
                    {{ $pengaduan->judul }}
                </div>
            </div>

            <form action="{{ route('petugas.pengaduan.tindaklanjut.store', $pengaduan->idpengaduan) }}"
                method="POST">
                @csrf

                <div class="form-group">
                    <label for="keterangan">Keterangan Tindak Lanjut <span style="color:red;">*</span></label>
                    <textarea name="keterangan"
                        id="keterangan"
                        required
                        placeholder="Tuliskan tindakan atau perkembangan penanganan pengaduan...">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status Penanganan <span style="color:red;">*</span></label>
                    <select name="status" id="status" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="diproses" {{ old('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    @error('status')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                    <div class="form-help">Status ini akan disinkronkan dengan status pengaduan oleh controller.</div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">Simpan Tindak Lanjut</button>
                    <a href="{{ route('petugas.pengaduan.tindaklanjut.index', $pengaduan->idpengaduan) }}"
                        class="btn-back">Batal</a>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection