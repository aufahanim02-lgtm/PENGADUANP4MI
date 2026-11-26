@extends('layouts.appetugas')

@section('page-title', 'Detail Pengaduan')

@section('content')

<style>
    .detail-page {
        padding: 5px 0 30px;
    }

    .page-heading {
        margin-bottom: 22px;
    }

    .page-heading h2 {
        font-size: 23px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
    }

    .page-heading p {
        color: #64748b;
        font-size: 13px;
        margin: 0;
    }

    .detail-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 13px;
        padding: 23px;
        margin-bottom: 20px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .035);
    }

    .ticket-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
        flex-wrap: wrap;
    }

    .ticket-number {
        color: #64748b;
        font-size: 12px;
        margin-bottom: 7px;
    }

    .ticket-title {
        font-size: 20px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .status {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-menunggu_verifikasi {
        background: #fff7ed;
        color: #c2410c;
    }

    .status-diproses {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-selesai {
        background: #dcfce7;
        color: #15803d;
    }

    .status-ditolak {
        background: #fee2e2;
        color: #b91c1c;
    }

    .section-title {
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
        padding-bottom: 14px;
        border-bottom: 1px solid #e2e8f0;
        margin-bottom: 18px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .detail-item {
        min-width: 0;
    }

    .detail-label {
        display: block;
        color: #64748b;
        font-size: 12px;
        margin-bottom: 6px;
    }

    .detail-value {
        color: #334155;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.7;
        overflow-wrap: anywhere;
        margin: 0;
    }

    .description {
        color: #475569;
        font-size: 13px;
        line-height: 1.8;
        white-space: pre-line;
        overflow-wrap: anywhere;
    }

    .alert {
        padding: 13px 16px;
        border-radius: 9px;
        margin-bottom: 18px;
        font-size: 13px;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
    }

    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
    }

    .alert-warning {
        background: #fff7ed;
        color: #9a3412;
    }

    .verification-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 20px;
    }

    .form-label {
        display: block;
        color: #334155;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 11px 12px;
        font-size: 13px;
        color: #334155;
        background: white;
        margin-bottom: 15px;
    }

    .form-control:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .1);
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border: none;
        border-radius: 8px;
        padding: 10px 17px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
    }

    .btn-success {
        background: #15803d;
        color: white;
    }

    .btn-danger {
        background: #dc2626;
        color: white;
    }

    .btn-secondary {
        background: #64748b;
        color: white;
    }

    .btn-primary {
        background: #2563eb;
        color: white;
    }

    .btn-info {
        background: #0891b2;
        color: white;
    }

    .btn:hover {
        opacity: .88;
        color: white;
        transform: translateY(-1px);
    }

    .action-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 5px;
    }

    /* AKSES FITUR */
    .feature-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 15px;
    }

    .feature-card {
        border: 1px solid #e2e8f0;
        border-radius: 11px;
        padding: 19px;
        background: #fff;
        transition: .2s;
    }

    .feature-card:hover {
        border-color: #93c5fd;
        box-shadow: 0 4px 14px rgba(37, 99, 235, .07);
    }

    .feature-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 21px;
        margin-bottom: 13px;
    }

    .feature-icon.blue {
        background: #dbeafe;
    }

    .feature-icon.cyan {
        background: #cffafe;
    }

    .feature-card h5 {
        color: #1e293b;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .feature-card p {
        color: #64748b;
        font-size: 12px;
        line-height: 1.7;
        min-height: 40px;
        margin-bottom: 13px;
    }

    .feature-count {
        color: #64748b;
        font-size: 11px;
        margin-bottom: 13px;
    }

    .feature-card .btn {
        width: 100%;
    }

    .evidence-item {
        padding: 13px;
        border: 1px solid #e2e8f0;
        border-radius: 9px;
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    .evidence-name {
        color: #334155;
        font-size: 13px;
        font-weight: 600;
    }

    .evidence-link {
        color: #2563eb;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
    }

    .empty-text {
        color: #94a3b8;
        font-size: 13px;
        text-align: center;
        padding: 15px;
    }

    .back-button {
        display: inline-block;
        color: #475569;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 18px;
    }

    .back-button:hover {
        color: #2563eb;
    }

    @media(max-width: 650px) {

        .detail-grid,
        .feature-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .detail-card {
            padding: 17px;
        }

        .ticket-title {
            font-size: 17px;
        }

        .action-group .btn {
            width: 100%;
        }
    }
</style>

<div class="detail-page">

    <a href="{{ route('petugas.pengaduan.index') }}" class="back-button">
        ← Kembali ke Data Pengaduan
    </a>

    <div class="page-heading">
        <h2>Detail Pengaduan</h2>
        <p>Periksa informasi, verifikasi, dan lakukan penanganan pengaduan.</p>
    </div>

    {{-- PESAN BERHASIL --}}
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    {{-- PESAN ERROR --}}
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    {{-- ERROR VALIDASI --}}
    @if($errors->any())
    <div class="alert alert-danger">
        <strong>Periksa kembali data berikut:</strong>
        <ul style="margin:8px 0 0 18px;">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- INFORMASI TIKET --}}
    <div class="detail-card">
        <div class="ticket-header">
            <div>
                <div class="ticket-number">
                    Nomor Tiket:
                    {{ $pengaduan->nomor_tiket ?? '-' }}
                </div>

                <h3 class="ticket-title">
                    {{ $pengaduan->judul }}
                </h3>
            </div>

            <span class="status status-{{ $pengaduan->status }}">
                {{ ucwords(str_replace('_', ' ', $pengaduan->status)) }}
            </span>
        </div>
    </div>

    {{-- VERIFIKASI PENGADUAN --}}
    @if($pengaduan->status === 'menunggu_verifikasi')

    <div class="detail-card">
        <h4 class="section-title">Verifikasi Pengaduan</h4>

        <div class="alert alert-warning">
            Pengaduan ini masih menunggu verifikasi.
            Periksa informasi pengaduan sebelum menentukan keputusan.
        </div>

        <div class="verification-box">

            {{-- FORM TERIMA --}}
            <form action="{{ route('petugas.pengaduan.verifikasi', $pengaduan->idpengaduan) }}"
                method="POST"
                onsubmit="return confirm('Apakah kamu yakin menerima pengaduan ini?')">

                @csrf
                @method('PATCH')

                <input type="hidden" name="status" value="diproses">

                <button type="submit" class="btn btn-success">
                    ✓ Terima Pengaduan
                </button>
            </form>

            <hr style="border:0;border-top:1px solid #e2e8f0;margin:18px 0;">

            {{-- FORM TOLAK --}}
            <form action="{{ route('petugas.pengaduan.verifikasi', $pengaduan->idpengaduan) }}"
                method="POST"
                onsubmit="return confirm('Apakah kamu yakin menolak pengaduan ini?')">

                @csrf
                @method('PATCH')

                <input type="hidden" name="status" value="ditolak">

                <label class="form-label">
                    Alasan Penolakan
                </label>

                <textarea
                    name="catatanpenolakan"
                    class="form-control"
                    rows="4"
                    placeholder="Tuliskan alasan penolakan pengaduan..."
                    required>{{ old('catatanpenolakan') }}</textarea>

                <button type="submit" class="btn btn-danger">
                    ✕ Tolak Pengaduan
                </button>
            </form>

        </div>
    </div>

    @elseif($pengaduan->status === 'ditolak')

    <div class="detail-card">
        <h4 class="section-title">Catatan Penolakan</h4>

        <div class="alert alert-danger">
            {{ $pengaduan->catatanpenolakan ?? 'Tidak ada catatan penolakan.' }}
        </div>
    </div>

    @endif

    {{-- AKSES PENGELOLAAN --}}
    <div class="detail-card">
        <h4 class="section-title">Pengelolaan Pengaduan</h4>

        <p style="color:#64748b;font-size:13px;margin-top:-5px;margin-bottom:18px;">
            Pilih fitur yang ingin dikelola untuk pengaduan ini.
        </p>

        <div class="feature-grid">

            {{-- BUKTI PENGADUAN --}}
            <div class="feature-card">

                <div class="feature-icon blue">
                    📎
                </div>

                <h5>Bukti Pengaduan</h5>

                <p>
                    Lihat, unggah, dan kelola foto atau dokumen
                    yang menjadi bukti pendukung pengaduan.
                </p>

                <div class="feature-count">
                    {{ $pengaduan->bukti->count() }} bukti tersimpan
                </div>

                <a href="{{ route('petugas.pengaduan.bukti.index', $pengaduan->idpengaduan) }}"
                    class="btn btn-primary">
                    Kelola Bukti →
                </a>

            </div>

            {{-- TINDAK LANJUT --}}
            <div class="feature-card">

                <div class="feature-icon cyan">
                    📝
                </div>

                <h5>Tindak Lanjut</h5>

                <p>
                    Tambahkan catatan tindakan, perbarui perkembangan,
                    dan pantau riwayat penanganan pengaduan.
                </p>

                <div class="feature-count">
                    {{ $pengaduan->tindaklanjut->count() }} riwayat tindak lanjut
                </div>

                <a href="{{ route('petugas.pengaduan.tindaklanjut.index', $pengaduan->idpengaduan) }}"
                    class="btn btn-info">
                    Kelola Tindak Lanjut →
                </a>

            </div>

        </div>
    </div>

    {{-- INFORMASI PENGADU --}}
    <div class="detail-card">
        <h4 class="section-title">Informasi Pengadu</h4>

        <div class="detail-grid">
            <div class="detail-item">
                <span class="detail-label">Nama Pengadu</span>
                <p class="detail-value">
                    {{ $pengaduan->pengadu->nama ?? '-' }}
                </p>
            </div>

            <div class="detail-item">
                <span class="detail-label">NIK</span>
                <p class="detail-value">
                    {{ $pengaduan->pengadu->nik ?? '-' }}
                </p>
            </div>

            <div class="detail-item">
                <span class="detail-label">Nomor HP</span>
                <p class="detail-value">
                    {{ $pengaduan->pengadu->nohp ?? '-' }}
                </p>
            </div>

            <div class="detail-item">
                <span class="detail-label">Alamat</span>
                <p class="detail-value">
                    {{ $pengaduan->pengadu->alamat ?? '-' }}
                </p>
            </div>
        </div>
    </div>

    {{-- INFORMASI PMI --}}
    <div class="detail-card">
        <h4 class="section-title">Informasi Pekerja Migran Indonesia</h4>

        @if($pengaduan->pmi)

        <div class="detail-grid">
            <div class="detail-item">
                <span class="detail-label">Nama PMI</span>
                <p class="detail-value">
                    {{ $pengaduan->pmi->nama }}
                </p>
            </div>

            <div class="detail-item">
                <span class="detail-label">NIK</span>
                <p class="detail-value">
                    {{ $pengaduan->pmi->nik ?? '-' }}
                </p>
            </div>

            <div class="detail-item">
                <span class="detail-label">Jenis Kelamin</span>
                <p class="detail-value">
                    {{ $pengaduan->pmi->jeniskelamin ?? '-' }}
                </p>
            </div>

            <div class="detail-item">
                <span class="detail-label">Negara Penempatan</span>
                <p class="detail-value">
                    {{ $pengaduan->pmi->negara ?? '-' }}
                </p>
            </div>

            <div class="detail-item">
                <span class="detail-label">Perusahaan</span>
                <p class="detail-value">
                    {{ $pengaduan->pmi->perusahaan ?? '-' }}
                </p>
            </div>

            <div class="detail-item">
                <span class="detail-label">Status PMI</span>
                <p class="detail-value">
                    {{ $pengaduan->pmi->statuspmi ?? '-' }}
                </p>
            </div>
        </div>

        @else
        <p class="empty-text">Tidak ada data PMI yang terhubung.</p>
        @endif
    </div>

    {{-- INFORMASI PENGADUAN --}}
    <div class="detail-card">
        <h4 class="section-title">Informasi Pengaduan</h4>

        <div class="detail-grid">
            <div class="detail-item">
                <span class="detail-label">Kategori</span>
                <p class="detail-value">
                    {{ $pengaduan->kategori->nama ?? '-' }}
                </p>
            </div>

            <div class="detail-item">
                <span class="detail-label">Tanggal Kejadian</span>
                <p class="detail-value">
                    {{ $pengaduan->tanggalkejadian
                        ? \Carbon\Carbon::parse($pengaduan->tanggalkejadian)->format('d-m-Y')
                        : '-' }}
                </p>
            </div>

            <div class="detail-item">
                <span class="detail-label">Wilayah</span>
                <p class="detail-value">
                    {{ $pengaduan->wilayah
                        ? collect([
                            $pengaduan->wilayah->desa,
                            $pengaduan->wilayah->kecamatan,
                            $pengaduan->wilayah->kabupaten,
                            $pengaduan->wilayah->provinsi
                        ])->filter()->implode(', ')
                        : '-' }}
                </p>
            </div>

            <div class="detail-item">
                <span class="detail-label">Lokasi Kejadian</span>
                <p class="detail-value">
                    {{ $pengaduan->lokasikejadian ?? '-' }}
                </p>
            </div>
        </div>

        <div style="margin-top:22px;">
            <span class="detail-label">Kronologi Pengaduan</span>

            <div class="description">
                {{ $pengaduan->kronologi }}
            </div>
        </div>
    </div>

    {{-- DAFTAR BUKTI PENGADUAN --}}
    <div class="detail-card">
        <h4 class="section-title">Daftar Bukti Pengaduan</h4>

        @forelse($pengaduan->bukti as $bukti)

        <div class="evidence-item">
            <div>
                <div class="evidence-name">
                    {{ $bukti->namafile }}
                </div>

                @if($bukti->keterangan)
                <small style="color:#64748b;">
                    {{ $bukti->keterangan }}
                </small>
                @endif
            </div>

            @if($bukti->pathfile)
            <a href="{{ asset('storage/' . $bukti->pathfile) }}"
                target="_blank"
                rel="noopener noreferrer"
                class="evidence-link">
                Lihat Bukti ↗
            </a>
            @endif
        </div>

        @empty
        <p class="empty-text">Belum ada bukti pengaduan.</p>
        @endforelse
    </div>

    {{-- RIWAYAT TINDAK LANJUT --}}
    <div class="detail-card">
        <h4 class="section-title">Riwayat Tindak Lanjut</h4>

        @forelse($pengaduan->tindaklanjut as $tindaklanjut)

        <div class="evidence-item">
            <div>
                <div class="evidence-name">
                    {{ ucwords(str_replace('_', ' ', $tindaklanjut->status ?? 'Tindak lanjut')) }}
                </div>

                <small style="color:#64748b;">
                    {{ $tindaklanjut->tanggal
                            ? \Carbon\Carbon::parse($tindaklanjut->tanggal)->format('d-m-Y H:i')
                            : '-' }}
                </small>

                <p class="description" style="margin:8px 0 0;">
                    {{ $tindaklanjut->keterangan }}
                </p>
            </div>
        </div>

        @empty
        <p class="empty-text">Belum ada riwayat tindak lanjut.</p>
        @endforelse
    </div>

    {{-- KEMBALI --}}
    <div class="action-group">
        <a href="{{ route('petugas.pengaduan.index') }}"
            class="btn btn-secondary">
            ← Kembali ke Data Pengaduan
        </a>
    </div>

</div>

@endsection