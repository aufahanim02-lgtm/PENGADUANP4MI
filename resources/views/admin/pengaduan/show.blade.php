 @extends('layouts.appadmin')

 @section('page-title', 'Detail Pengaduan')

 @section('content')

 <style>
     .detail-page {
         padding: 8px 0 35px;
         color: #334155;
     }

     .detail-page * {
         box-sizing: border-box;
     }

     /* HEADER */
     .detail-header {
         display: flex;
         justify-content: space-between;
         align-items: center;
         gap: 15px;
         margin-bottom: 22px;
         flex-wrap: wrap;
     }

     .detail-header h3 {
         font-size: 24px;
         font-weight: 800;
         color: #172554;
         margin: 0 0 6px;
     }

     .detail-header p {
         color: #64748b;
         font-size: 13px;
         margin: 0;
     }

     .btn-back {
         display: inline-flex;
         align-items: center;
         gap: 7px;
         padding: 10px 16px;
         border-radius: 9px;
         background: #fff;
         border: 1px solid #e2e8f0;
         color: #334155;
         text-decoration: none;
         font-size: 13px;
         font-weight: 700;
         transition: .2s;
     }

     .btn-back:hover {
         background: #f1f5f9;
         color: #1d4ed8;
     }

     /* TICKET SUMMARY */
     .ticket-card {
         display: flex;
         justify-content: space-between;
         align-items: center;
         gap: 20px;
         flex-wrap: wrap;
         padding: 23px 25px;
         background: #fff;
         border: 1px solid #e2e8f0;
         border-radius: 14px;
         margin-bottom: 22px;
         box-shadow: 0 3px 12px rgba(15, 23, 42, .035);
     }

     .ticket-label {
         color: #64748b;
         font-size: 12px;
         margin-bottom: 7px;
     }

     .ticket-number {
         color: #172554;
         font-size: 21px;
         font-weight: 800;
         letter-spacing: .3px;
         overflow-wrap: anywhere;
     }

     .ticket-status {
         text-align: right;
     }

     .ticket-status small {
         display: block;
         color: #64748b;
         font-size: 12px;
         margin-bottom: 8px;
     }

     .status-badge {
         display: inline-block;
         padding: 8px 14px;
         border-radius: 30px;
         font-size: 12px;
         font-weight: 700;
     }

     .status-menunggu_verifikasi {
         background: #fef3c7;
         color: #92400e;
     }

     .status-diverifikasi {
         background: #dbeafe;
         color: #1e40af;
     }

     .status-diproses {
         background: #e0f2fe;
         color: #075985;
     }

     .status-selesai {
         background: #dcfce7;
         color: #166534;
     }

     .status-ditolak {
         background: #fee2e2;
         color: #991b1b;
     }

     .status-default {
         background: #f1f5f9;
         color: #475569;
     }

     /* SECTION */
     .detail-section {
         background: #fff;
         border: 1px solid #e2e8f0;
         border-radius: 13px;
         margin-bottom: 20px;
         overflow: hidden;
         box-shadow: 0 3px 12px rgba(15, 23, 42, .035);
     }

     .section-heading {
         display: flex;
         align-items: center;
         gap: 12px;
         padding: 17px 21px;
         background: #fff;
         border-bottom: 1px solid #edf1f5;
     }

     .section-icon {
         display: flex;
         align-items: center;
         justify-content: center;
         width: 36px;
         height: 36px;
         flex-shrink: 0;
         border-radius: 9px;
         background: #eff6ff;
         color: #1d4ed8;
         font-size: 16px;
         font-weight: 800;
     }

     .section-heading h5 {
         color: #172554;
         font-size: 14px;
         font-weight: 800;
         margin: 0 0 3px;
     }

     .section-heading p {
         color: #94a3b8;
         font-size: 11px;
         margin: 0;
     }

     .section-body {
         padding: 22px;
     }

     /* DETAIL GRID */
     .detail-grid {
         display: grid;
         grid-template-columns: repeat(2, minmax(0, 1fr));
         gap: 22px 28px;
     }

     .detail-item {
         min-width: 0;
     }

     .detail-item.full-width {
         grid-column: 1 / -1;
     }

     .detail-label {
         display: block;
         color: #94a3b8;
         font-size: 11px;
         font-weight: 700;
         text-transform: uppercase;
         letter-spacing: .45px;
         margin-bottom: 7px;
     }

     .detail-value {
         color: #1e293b;
         font-size: 13px;
         font-weight: 600;
         line-height: 1.6;
         margin: 0;
         overflow-wrap: anywhere;
     }

     .description-box {
         padding: 15px 17px;
         background: #f8fafc;
         border: 1px solid #e8edf3;
         border-radius: 9px;
         color: #475569;
         font-size: 13px;
         line-height: 1.8;
         white-space: pre-line;
         overflow-wrap: anywhere;
     }

     .warning-box {
         padding: 15px 17px;
         background: #fff7ed;
         border: 1px solid #fed7aa;
         border-radius: 9px;
         color: #9a3412;
         font-size: 13px;
         line-height: 1.7;
         white-space: pre-line;
     }

     /* LIST */
     .record-list {
         display: flex;
         flex-direction: column;
         gap: 12px;
     }

     .record-item {
         padding: 16px;
         border: 1px solid #e8edf3;
         border-radius: 10px;
         background: #fff;
     }

     .record-item-title {
         color: #172554;
         font-size: 13px;
         font-weight: 800;
         margin-bottom: 7px;
         overflow-wrap: anywhere;
     }

     .record-item-info {
         color: #64748b;
         font-size: 12px;
         line-height: 1.8;
         overflow-wrap: anywhere;
     }

     .btn-file {
         display: inline-flex;
         align-items: center;
         gap: 6px;
         margin-top: 12px;
         padding: 8px 12px;
         background: #eff6ff;
         color: #1d4ed8;
         border-radius: 7px;
         text-decoration: none;
         font-size: 12px;
         font-weight: 700;
     }

     .btn-file:hover {
         background: #dbeafe;
         color: #1e40af;
     }

     .empty-message {
         padding: 25px 15px;
         border: 1px dashed #cbd5e1;
         border-radius: 9px;
         background: #f8fafc;
         color: #94a3b8;
         font-size: 13px;
         text-align: center;
     }

     .empty-icon {
         display: block;
         font-size: 23px;
         margin-bottom: 8px;
     }

     /* RESPONSIVE */
     @media (max-width: 650px) {
         .detail-header {
             align-items: flex-start;
         }

         .ticket-card {
             padding: 18px;
         }

         .ticket-number {
             font-size: 17px;
         }

         .ticket-status {
             text-align: left;
         }

         .section-body {
             padding: 17px;
         }

         .section-heading {
             padding: 15px 17px;
         }

         .detail-grid {
             grid-template-columns: 1fr;
             gap: 18px;
         }

         .detail-item.full-width {
             grid-column: auto;
         }
     }
 </style>

 @php
 $status = $pengaduan->status ?? '';

 $labelStatus = [
 'menunggu_verifikasi' => 'Menunggu Verifikasi',
 'diverifikasi' => 'Diverifikasi',
 'diproses' => 'Sedang Diproses',
 'selesai' => 'Selesai',
 'ditolak' => 'Ditolak',
 ];

 $statusClass = in_array($status, [
 'menunggu_verifikasi',
 'diverifikasi',
 'diproses',
 'selesai',
 'ditolak'
 ]) ? 'status-' . $status : 'status-default';
 @endphp

 <div class="detail-page">

     {{-- HEADER HALAMAN --}}
     <div class="detail-header">
         <div>
             <h3>Detail Pengaduan</h3>
             <p>Informasi lengkap laporan pengaduan pekerja migran Indonesia.</p>
         </div>

         <a href="{{ route('admin.pengaduan.index') }}" class="btn-back">
             <span>←</span> Kembali ke Daftar
         </a>
     </div>

     {{-- RINGKASAN TIKET --}}
     <div class="ticket-card">
         <div>
             <div class="ticket-label">Nomor Tiket Pengaduan</div>
             <div class="ticket-number">
                 {{ $pengaduan->nomor_tiket ?? '-' }}
             </div>
         </div>

         <div class="ticket-status">
             <small>Status Pengaduan</small>
             <span class="status-badge {{ $statusClass }}">
                 {{ $labelStatus[$status] ?? ucfirst(str_replace('_', ' ', $status)) }}
             </span>
         </div>
     </div>

     {{-- PENUGASAN PETUGAS --}}
     <div class="detail-section" style="margin-bottom:22px;">

         <div class="section-heading">
             <div class="section-icon">06</div>
             <div>
                 <h5>Penugasan Petugas</h5>
                 <p>Pilih Petugas yang bertanggung jawab menangani pengaduan ini.</p>
             </div>
         </div>

         <div class="section-body">

             @if(session('success'))
             <div style="padding:13px 16px;background:#dcfce7;color:#166534;border:1px solid #bbf7d0;border-radius:9px;margin-bottom:18px;font-size:13px;">
                 {{ session('success') }}
             </div>
             @endif

             @if($errors->any())
             <div style="padding:13px 16px;background:#fee2e2;color:#991b1b;border:1px solid #fecaca;border-radius:9px;margin-bottom:18px;font-size:13px;">
                 @foreach($errors->all() as $error)
                 <div>{{ $error }}</div>
                 @endforeach
             </div>
             @endif

             <div style="margin-bottom:18px;">
                 <span class="detail-label">Petugas Saat Ini</span>

                 <p class="detail-value">
                     @if($pengaduan->petugas)
                     {{ $pengaduan->petugas->nama }}
                     @else
                     <span style="color:#dc2626;">Belum ada Petugas yang ditugaskan</span>
                     @endif
                 </p>
             </div>

             @if($petugas->count() > 0)

             <form action="{{ route('admin.pengaduan.tugaskan', $pengaduan->idpengaduan) }}"
                 method="POST">

                 @csrf

                 <div style="display:flex;gap:12px;align-items:flex-end;flex-wrap:wrap;">

                     <div style="flex:1;min-width:230px;">
                         <label for="iduser"
                             style="display:block;font-size:12px;font-weight:700;color:#475569;margin-bottom:8px;">
                             Pilih Petugas
                         </label>

                         <select name="iduser"
                             id="iduser"
                             required
                             style="width:100%;padding:12px;border:1px solid #cbd5e1;border-radius:8px;background:#fff;color:#334155;font-size:13px;">

                             <option value="">-- Pilih Petugas --</option>

                             @foreach($petugas as $item)
                             <option value="{{ $item->iduser }}"
                                 {{ (string) old('iduser', $pengaduan->iduser) === (string) $item->iduser ? 'selected' : '' }}>
                                 {{ $item->nama }} ({{ $item->username }})
                             </option>
                             @endforeach

                         </select>
                     </div>

                     <button type="submit"
                         style="padding:12px 20px;border:0;border-radius:8px;background:#1d4ed8;color:white;font-size:13px;font-weight:700;cursor:pointer;">
                         Tugaskan Pengaduan
                     </button>

                 </div>
             </form>

             @else

             <div class="empty-message">
                 <span class="empty-icon">ⓘ</span>
                 Belum ada akun Petugas aktif. Silakan tambahkan akun Petugas melalui Data User.
             </div>

             @endif

         </div>
     </div>


     {{-- INFORMASI PENGADUAN --}}
     <div class="detail-section">

         <div class="section-heading">
             <div class="section-icon">01</div>
             <div>
                 <h5>Informasi Pengaduan</h5>
                 <p>Informasi utama laporan yang disampaikan.</p>
             </div>
         </div>

         <div class="section-body">

             <div class="detail-grid">

                 <div class="detail-item full-width">
                     <span class="detail-label">Judul Pengaduan</span>
                     <p class="detail-value">{{ $pengaduan->judul ?? '-' }}</p>
                 </div>

                 <div class="detail-item">
                     <span class="detail-label">Kategori Pengaduan</span>
                     <p class="detail-value">{{ $pengaduan->kategori->nama ?? '-' }}</p>
                 </div>

                 <div class="detail-item">
                     <span class="detail-label">Tanggal Kejadian</span>
                     <p class="detail-value">
                         {{ $pengaduan->tanggalkejadian ? \Carbon\Carbon::parse($pengaduan->tanggalkejadian)->format('d F Y') : '-' }}
                     </p>
                 </div>

                 <div class="detail-item">
                     <span class="detail-label">Lokasi Kejadian</span>
                     <p class="detail-value">{{ $pengaduan->lokasikejadian ?? '-' }}</p>
                 </div>

                 <div class="detail-item">
                     <span class="detail-label">Tanggal Laporan Dibuat</span>
                     <p class="detail-value">
                         {{ $pengaduan->created_at ? $pengaduan->created_at->format('d F Y, H:i') . ' WIB' : '-' }}
                     </p>
                 </div>

                 <div class="detail-item">
                     <span class="detail-label">Petugas Penanganan</span>
                     <p class="detail-value">
                         {{ $pengaduan->petugas->nama ?? 'Belum ditugaskan' }}
                     </p>
                 </div>

                 <div class="detail-item full-width">
                     <span class="detail-label">Kronologi Pengaduan</span>
                     <div class="description-box">
                         {{ $pengaduan->kronologi ?? '-' }}
                     </div>
                 </div>

                 @if($pengaduan->catatanpenolakan)
                 <div class="detail-item full-width">
                     <span class="detail-label">Catatan Penolakan</span>
                     <div class="warning-box">
                         {{ $pengaduan->catatanpenolakan }}
                     </div>
                 </div>
                 @endif

             </div>

         </div>
     </div>

     {{-- IDENTITAS PENGADU --}}
     <div class="detail-section">

         <div class="section-heading">
             <div class="section-icon">02</div>
             <div>
                 <h5>Identitas Pengadu</h5>
                 <p>Informasi akun yang mengirimkan laporan.</p>
             </div>
         </div>

         <div class="section-body">

             <div class="detail-grid">

                 <div class="detail-item">
                     <span class="detail-label">Nama Lengkap</span>
                     <p class="detail-value">{{ $pengaduan->pengadu->nama ?? '-' }}</p>
                 </div>

                 <div class="detail-item">
                     <span class="detail-label">NIK</span>
                     <p class="detail-value">{{ $pengaduan->pengadu->nik ?? '-' }}</p>
                 </div>

                 <div class="detail-item">
                     <span class="detail-label">Nomor HP</span>
                     <p class="detail-value">{{ $pengaduan->pengadu->nohp ?? '-' }}</p>
                 </div>

                 <div class="detail-item">
                     <span class="detail-label">Username</span>
                     <p class="detail-value">{{ $pengaduan->pengadu->username ?? '-' }}</p>
                 </div>

                 <div class="detail-item full-width">
                     <span class="detail-label">Alamat</span>
                     <p class="detail-value">{{ $pengaduan->pengadu->alamat ?? '-' }}</p>
                 </div>

             </div>

         </div>
     </div>

     {{-- DATA PMI --}}
     <div class="detail-section">

         <div class="section-heading">
             <div class="section-icon">03</div>
             <div>
                 <h5>Informasi Pekerja Migran Indonesia</h5>
                 <p>Data PMI yang berkaitan dengan laporan.</p>
             </div>
         </div>

         <div class="section-body">

             @if($pengaduan->pmi)

             <div class="detail-grid">

                 <div class="detail-item">
                     <span class="detail-label">Nama PMI</span>
                     <p class="detail-value">{{ $pengaduan->pmi->nama ?? '-' }}</p>
                 </div>

                 <div class="detail-item">
                     <span class="detail-label">NIK PMI</span>
                     <p class="detail-value">{{ $pengaduan->pmi->nik ?? '-' }}</p>
                 </div>

                 <div class="detail-item">
                     <span class="detail-label">Jenis Kelamin</span>
                     <p class="detail-value">{{ $pengaduan->pmi->jeniskelamin ?? '-' }}</p>
                 </div>

                 <div class="detail-item">
                     <span class="detail-label">Tanggal Lahir</span>
                     <p class="detail-value">
                         {{ $pengaduan->pmi->tanggallahir ? \Carbon\Carbon::parse($pengaduan->pmi->tanggallahir)->format('d F Y') : '-' }}
                     </p>
                 </div>

                 <div class="detail-item">
                     <span class="detail-label">Negara Penempatan</span>
                     <p class="detail-value">{{ $pengaduan->pmi->negara ?? '-' }}</p>
                 </div>

                 <div class="detail-item">
                     <span class="detail-label">Perusahaan</span>
                     <p class="detail-value">{{ $pengaduan->pmi->perusahaan ?? '-' }}</p>
                 </div>

                 <div class="detail-item">
                     <span class="detail-label">Nomor HP PMI</span>
                     <p class="detail-value">{{ $pengaduan->pmi->nohp ?? '-' }}</p>
                 </div>

                 <div class="detail-item">
                     <span class="detail-label">Status PMI</span>
                     <p class="detail-value">{{ $pengaduan->pmi->statuspmi ?? '-' }}</p>
                 </div>

                 <div class="detail-item full-width">
                     <span class="detail-label">Alamat Kerja</span>
                     <p class="detail-value">{{ $pengaduan->pmi->alamatkerja ?? '-' }}</p>
                 </div>

             </div>

             @else

             <div class="empty-message">
                 <span class="empty-icon">ⓘ</span>
                 Tidak ada data PMI yang terhubung dengan pengaduan ini.
             </div>

             @endif

         </div>
     </div>

     {{-- BUKTI PENGADUAN --}}
     <div class="detail-section">

         <div class="section-heading">
             <div class="section-icon">04</div>
             <div>
                 <h5>Bukti Pengaduan</h5>
                 <p>Dokumen atau file pendukung laporan.</p>
             </div>
         </div>

         <div class="section-body">

             @if($pengaduan->bukti && $pengaduan->bukti->count() > 0)

             <div class="record-list">

                 @foreach($pengaduan->bukti as $bukti)

                 <div class="record-item">

                     <div class="record-item-title">
                         {{ $bukti->namafile ?? 'File Bukti' }}
                     </div>

                     <div class="record-item-info">
                         Jenis file: {{ $bukti->jenisfile ?? '-' }}
                         <br>
                         Ukuran file: {{ $bukti->ukuranfile ?? '-' }}
                         <br>
                         Keterangan: {{ $bukti->keterangan ?? '-' }}
                     </div>

                     @if($bukti->pathfile)
                     <a
                         href="{{ asset('storage/' . $bukti->pathfile) }}"
                         target="_blank"
                         rel="noopener noreferrer"
                         class="btn-file">
                         Lihat / Unduh Bukti →
                     </a>
                     @endif

                 </div>

                 @endforeach

             </div>

             @else

             <div class="empty-message">
                 <span class="empty-icon">ⓘ</span>
                 Belum ada bukti yang dilampirkan pada pengaduan ini.
             </div>

             @endif

         </div>
     </div>

     {{-- RIWAYAT TINDAK LANJUT --}}
     <div class="detail-section">

         <div class="section-heading">
             <div class="section-icon">05</div>
             <div>
                 <h5>Riwayat Tindak Lanjut</h5>
                 <p>Catatan proses penanganan laporan oleh petugas.</p>
             </div>
         </div>

         <div class="section-body">

             @if($pengaduan->tindaklanjut && $pengaduan->tindaklanjut->count() > 0)

             <div class="record-list">

                 @foreach($pengaduan->tindaklanjut as $riwayat)

                 <div class="record-item">

                     <div class="record-item-title">
                         {{ $riwayat->status ?? 'Tindak Lanjut' }}
                     </div>

                     <div class="record-item-info">
                         {{ $riwayat->keterangan ?? '-' }}
                         <br><br>
                         Petugas: {{ $riwayat->petugas->nama ?? '-' }}
                         <br>
                         Tanggal:
                         {{ $riwayat->tanggal ? \Carbon\Carbon::parse($riwayat->tanggal)->format('d F Y') : '-' }}
                     </div>

                 </div>

                 @endforeach

             </div>

             @else

             <div class="empty-message">
                 <span class="empty-icon">ⓘ</span>
                 Belum ada riwayat tindak lanjut untuk pengaduan ini.
             </div>

             @endif

         </div>
     </div>

     {{-- TOMBOL KEMBALI --}}
     <div style="display:flex; justify-content:flex-end; margin-top:22px;">
         <a href="{{ route('admin.pengaduan.index') }}" class="btn-back">
             ← Kembali ke Daftar Pengaduan
         </a>
     </div>

 </div>

 @endsection