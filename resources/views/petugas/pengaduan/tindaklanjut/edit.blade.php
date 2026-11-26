@extends('layouts.appetugas')

@section('page-title', 'Edit Tindak Lanjut')

@section('content')

<style>
    .edit-page {
        max-width: 850px;
        padding: 5px;
    }

    .edit-heading {
        margin-bottom: 22px;
    }

    .edit-heading h2 {
        font-size: 23px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
    }

    .edit-heading p {
        color: #64748b;
        font-size: 14px;
        margin: 0;
    }

    .edit-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
    }

    .edit-card-header {
        padding: 18px 20px;
        border-bottom: 1px solid #e2e8f0;
    }

    .edit-card-header h3 {
        margin: 0;
        font-size: 17px;
        color: #1e293b;
    }

    .edit-body {
        padding: 22px;
    }

    .edit-group {
        margin-bottom: 19px;
    }

    .edit-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
    }

    .edit-group textarea,
    .edit-group select {
        width: 100%;
        box-sizing: border-box;
        padding: 12px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 13px;
    }

    .edit-group textarea {
        min-height: 150px;
        resize: vertical;
    }

    .edit-group textarea:focus,
    .edit-group select:focus {
        outline: none;
        border-color: #2563eb;
    }

    .edit-error {
        color: #dc2626;
        font-size: 12px;
        margin-top: 6px;
    }

    .edit-alert {
        background: #fee2e2;
        color: #991b1b;
        padding: 13px;
        border-radius: 8px;
        margin-bottom: 17px;
        font-size: 13px;
    }

    .edit-actions {
        display: flex;
        gap: 9px;
        flex-wrap: wrap;
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
</style>

<div class="edit-page">

    <div class="edit-heading">
        <h2>Edit Tindak Lanjut</h2>
        <p>Perbarui catatan dan status penanganan pengaduan.</p>
    </div>

    @if($errors->any())
    <div class="edit-alert">
        <strong>Periksa kembali data berikut:</strong>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="edit-card">
        <div class="edit-card-header">
            <h3>Formulir Edit Tindak Lanjut</h3>
        </div>

        <div class="edit-body">

            <div style="background:#f8fafc;padding:14px;border-radius:8px;margin-bottom:20px;">
                <div style="font-size:12px;color:#64748b;">Nomor Tiket</div>
                <strong>{{ $pengaduan->nomor_tiket ?? '-' }}</strong>
                <div style="font-size:13px;color:#475569;margin-top:5px;">{{ $pengaduan->judul }}</div>
            </div>

            <form action="{{ route('petugas.pengaduan.tindaklanjut.update', [$pengaduan->idpengaduan, $tindaklanjut->idtindaklanjut]) }}"
                method="POST">
                @csrf
                @method('PUT')

                <div class="edit-group">
                    <label for="keterangan">Keterangan Tindak Lanjut <span style="color:red;">*</span></label>
                    <textarea name="keterangan"
                        id="keterangan"
                        required>{{ old('keterangan', $tindaklanjut->keterangan) }}</textarea>
                    @error('keterangan')
                    <div class="edit-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="edit-group">
                    <label for="status">Status Penanganan <span style="color:red;">*</span></label>
                    <select name="status" id="status" required>
                        <option value="diproses" {{ old('status', $tindaklanjut->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ old('status', $tindaklanjut->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="ditolak" {{ old('status', $tindaklanjut->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    @error('status')
                    <div class="edit-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="edit-actions">
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                    <a href="{{ route('petugas.pengaduan.tindaklanjut.index', $pengaduan->idpengaduan) }}"
                        class="btn-back">Batal</a>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection