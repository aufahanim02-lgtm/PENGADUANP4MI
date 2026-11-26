 @extends('layouts.appadmin')

 @section('page-title', 'Detail Data Pengadu')

 @section('content')

 <style>
     .pengadu-detail {
         padding: 10px 0 30px;
     }

     .detail-heading {
         margin-bottom: 24px;
     }

     .detail-heading h3 {
         color: #172554;
         font-size: 24px;
         font-weight: 800;
         margin-bottom: 7px;
     }

     .detail-heading p {
         color: #64748b;
         font-size: 14px;
         margin: 0;
     }

     .detail-card {
         background: #fff;
         border: 1px solid #e2e8f0;
         border-radius: 14px;
         box-shadow: 0 4px 15px rgba(15, 23, 42, .04);
         overflow: hidden;
         margin-bottom: 20px;
     }

     .detail-card-header {
         padding: 18px 22px;
         background: #f8fafc;
         border-bottom: 1px solid #e2e8f0;
     }

     .detail-card-header h5 {
         color: #172554;
         font-size: 16px;
         font-weight: 750;
         margin: 0;
     }

     .detail-card-body {
         padding: 24px;
     }

     .profile-box {
         display: flex;
         align-items: center;
         gap: 18px;
     }

     .profile-avatar {
         width: 68px;
         height: 68px;
         flex-shrink: 0;
         border-radius: 16px;
         background: #dbeafe;
         color: #1d4ed8;
         display: flex;
         align-items: center;
         justify-content: center;
         font-size: 27px;
         font-weight: 800;
     }

     .profile-info h4 {
         color: #172554;
         font-size: 20px;
         font-weight: 800;
         margin-bottom: 5px;
     }

     .profile-info p {
         color: #64748b;
         font-size: 13px;
         margin: 0;
     }

     .status-badge {
         display: inline-block;
         padding: 6px 12px;
         border-radius: 20px;
         font-size: 11px;
         font-weight: 700;
     }

     .status-active {
         background: #dcfce7;
         color: #15803d;
     }

     .status-inactive {
         background: #fee2e2;
         color: #b91c1c;
     }

     .detail-item {
         margin-bottom: 22px;
     }

     .detail-item:last-child {
         margin-bottom: 0;
     }

     .detail-label {
         display: block;
         color: #94a3b8;
         font-size: 11px;
         font-weight: 700;
         text-transform: uppercase;
         letter-spacing: .5px;
         margin-bottom: 7px;
     }

     .detail-value {
         color: #334155;
         font-size: 14px;
         font-weight: 600;
         overflow-wrap: anywhere;
     }

     .detail-actions {
         display: flex;
         justify-content: space-between;
         align-items: center;
         flex-wrap: wrap;
         gap: 12px;
         padding: 18px 22px;
         background: #f8fafc;
         border-top: 1px solid #e2e8f0;
     }

     .btn-back {
         background: #fff;
         color: #475569;
         border: 1px solid #cbd5e1;
         padding: 10px 18px;
         border-radius: 8px;
         font-size: 13px;
         font-weight: 700;
         text-decoration: none;
     }

     .btn-edit {
         background: #1d4ed8;
         color: #fff;
         padding: 10px 18px;
         border-radius: 8px;
         font-size: 13px;
         font-weight: 700;
         text-decoration: none;
     }

     .btn-back:hover {
         background: #f1f5f9;
         color: #1e293b;
     }

     .btn-edit:hover {
         background: #1e40af;
         color: #fff;
     }

     @media (max-width: 576px) {
         .detail-card-body {
             padding: 18px;
         }

         .profile-box {
             align-items: flex-start;
         }

         .detail-actions {
             flex-direction: column-reverse;
             align-items: stretch;
         }

         .detail-actions a {
             text-align: center;
         }
     }
 </style>

 <div class="pengadu-detail">

     <div class="detail-heading">
         <h3>Detail Data Pengadu</h3>
         <p>Informasi lengkap identitas dan akun pengadu.</p>
     </div>

     {{-- PROFIL PENGADU --}}
     <div class="detail-card">
         <div class="detail-card-body">

             <div class="profile-box">

                 <div class="profile-avatar">
                     {{ strtoupper(substr($pengadu->nama, 0, 1)) }}
                 </div>

                 <div class="profile-info">
                     <h4>{{ $pengadu->nama }}</h4>

                     <p>
                         Username: {{ $pengadu->username }}
                     </p>

                     <div class="mt-2">
                         @if ($pengadu->aktif)
                         <span class="status-badge status-active">
                             Aktif
                         </span>
                         @else
                         <span class="status-badge status-inactive">
                             Tidak Aktif
                         </span>
                         @endif
                     </div>
                 </div>

             </div>

         </div>
     </div>

     {{-- IDENTITAS --}}
     <div class="detail-card">

         <div class="detail-card-header">
             <h5>Informasi Identitas</h5>
         </div>

         <div class="detail-card-body">
             <div class="row">

                 <div class="col-md-6">
                     <div class="detail-item">
                         <span class="detail-label">Nama Lengkap</span>
                         <div class="detail-value">{{ $pengadu->nama }}</div>
                     </div>
                 </div>

                 <div class="col-md-6">
                     <div class="detail-item">
                         <span class="detail-label">NIK</span>
                         <div class="detail-value">{{ $pengadu->nik ?: '-' }}</div>
                     </div>
                 </div>

                 <div class="col-md-6">
                     <div class="detail-item">
                         <span class="detail-label">Nomor HP</span>
                         <div class="detail-value">{{ $pengadu->nohp ?: '-' }}</div>
                     </div>
                 </div>

                 <div class="col-md-6">
                     <div class="detail-item">
                         <span class="detail-label">Alamat</span>
                         <div class="detail-value">{{ $pengadu->alamat ?: '-' }}</div>
                     </div>
                 </div>

             </div>
         </div>
     </div>

     {{-- AKUN --}}
     <div class="detail-card">

         <div class="detail-card-header">
             <h5>Informasi Akun</h5>
         </div>

         <div class="detail-card-body">
             <div class="row">

                 <div class="col-md-6">
                     <div class="detail-item">
                         <span class="detail-label">Username</span>
                         <div class="detail-value">{{ $pengadu->username }}</div>
                     </div>
                 </div>

                 <div class="col-md-6">
                     <div class="detail-item">
                         <span class="detail-label">Tanggal Terdaftar</span>
                         <div class="detail-value">
                             {{ $pengadu->created_at ? $pengadu->created_at->format('d-m-Y H:i') : '-' }}
                         </div>
                     </div>
                 </div>

             </div>
         </div>
     </div>

     {{-- RINGKASAN DATA --}}
     <div class="detail-card">

         <div class="detail-card-header">
             <h5>Ringkasan Aktivitas</h5>
         </div>

         <div class="detail-card-body">
             <div class="row">

                 <div class="col-md-6">
                     <div class="detail-item">
                         <span class="detail-label">Jumlah Data PMI</span>
                         <div class="detail-value">
                             {{ $pengadu->pmi->count() }} Data PMI
                         </div>
                     </div>
                 </div>

                 <div class="col-md-6">
                     <div class="detail-item">
                         <span class="detail-label">Jumlah Pengaduan</span>
                         <div class="detail-value">
                             {{ $pengadu->pengaduan->count() }} Pengaduan
                         </div>
                     </div>
                 </div>

             </div>
         </div>
     </div>

     {{-- TOMBOL --}}
     <div class="detail-card">
         <div class="detail-actions">

             <a href="{{ route('admin.pengadu.index') }}" class="btn-back">
                 Kembali
             </a>

             <a href="{{ route('admin.pengadu.edit', $pengadu->idpengadu) }}"
                 class="btn-edit">
                 Edit Data Pengadu
             </a>

         </div>
     </div>

 </div>

 @endsection