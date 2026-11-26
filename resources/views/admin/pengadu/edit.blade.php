 @extends('layouts.appadmin')

 @section('page-title', 'Edit Data Pengadu')

 @section('content')

 <style>
     .pengadu-edit {
         padding: 10px 0 30px;
     }

     .form-heading {
         margin-bottom: 24px;
     }

     .form-heading h3 {
         color: #172554;
         font-size: 24px;
         font-weight: 800;
         margin-bottom: 7px;
     }

     .form-heading p {
         color: #64748b;
         margin: 0;
         font-size: 14px;
     }

     .form-card {
         background: #fff;
         border: 1px solid #e2e8f0;
         border-radius: 14px;
         box-shadow: 0 4px 15px rgba(15, 23, 42, .04);
         overflow: hidden;
         margin-bottom: 20px;
     }

     .form-card-header {
         padding: 18px 22px;
         border-bottom: 1px solid #e2e8f0;
         background: #f8fafc;
     }

     .form-card-header h5 {
         color: #172554;
         font-size: 16px;
         font-weight: 750;
         margin: 0 0 4px;
     }

     .form-card-header p {
         color: #64748b;
         font-size: 12px;
         margin: 0;
     }

     .form-card-body {
         padding: 24px;
     }

     .form-label {
         color: #334155;
         font-size: 13px;
         font-weight: 700;
         margin-bottom: 8px;
     }

     .form-control,
     .form-select {
         min-height: 44px;
         border: 1px solid #cbd5e1;
         border-radius: 8px;
         font-size: 13px;
         box-shadow: none !important;
     }

     textarea.form-control {
         min-height: 105px;
         resize: vertical;
     }

     .form-control:focus,
     .form-select:focus {
         border-color: #2563eb;
     }

     .form-text {
         font-size: 11px;
         color: #94a3b8;
         margin-top: 6px;
     }

     .required {
         color: #dc2626;
     }

     .form-actions {
         display: flex;
         justify-content: space-between;
         align-items: center;
         gap: 12px;
         flex-wrap: wrap;
         padding: 18px 22px;
         border-top: 1px solid #e2e8f0;
         background: #f8fafc;
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

     .btn-save {
         background: #1d4ed8;
         color: #fff;
         border: none;
         padding: 11px 20px;
         border-radius: 8px;
         font-size: 13px;
         font-weight: 700;
     }

     .btn-save:hover {
         background: #1e40af;
         color: #fff;
     }

     .btn-back:hover {
         background: #f1f5f9;
         color: #1e293b;
     }

     @media (max-width: 576px) {
         .form-card-body {
             padding: 18px;
         }

         .form-actions {
             align-items: stretch;
             flex-direction: column-reverse;
         }

         .form-actions a,
         .form-actions button {
             width: 100%;
             text-align: center;
         }
     }
 </style>

 <div class="pengadu-edit">

     <div class="form-heading">
         <h3>Edit Data Pengadu</h3>
         <p>Perbarui informasi identitas dan akun pengadu.</p>
     </div>

     @if ($errors->any())
     <div class="alert alert-danger">
         <strong>Data belum berhasil diperbarui.</strong>
         <ul class="mb-0 mt-2">
             @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
     @endif

     <form action="{{ route('admin.pengadu.update', $pengadu->idpengadu) }}" method="POST">
         @csrf
         @method('PUT')

         {{-- INFORMASI IDENTITAS --}}
         <div class="form-card">

             <div class="form-card-header">
                 <h5>Informasi Identitas</h5>
                 <p>Perbarui data pribadi pengadu.</p>
             </div>

             <div class="form-card-body">
                 <div class="row g-3">

                     <div class="col-md-6">
                         <label class="form-label">
                             Nama Lengkap <span class="required">*</span>
                         </label>

                         <input type="text"
                             name="nama"
                             class="form-control"
                             value="{{ old('nama', $pengadu->nama) }}"
                             placeholder="Masukkan nama lengkap"
                             required>
                     </div>

                     <div class="col-md-6">
                         <label class="form-label">NIK</label>

                         <input type="text"
                             name="nik"
                             class="form-control"
                             value="{{ old('nik', $pengadu->nik) }}"
                             placeholder="Masukkan 16 digit NIK"
                             maxlength="16">
                     </div>

                     <div class="col-md-6">
                         <label class="form-label">Nomor HP</label>

                         <input type="text"
                             name="nohp"
                             class="form-control"
                             value="{{ old('nohp', $pengadu->nohp) }}"
                             placeholder="Contoh: 081234567890">
                     </div>

                     <div class="col-md-6">
                         <label class="form-label">
                             Status Akun <span class="required">*</span>
                         </label>

                         <select name="aktif" class="form-select" required>
                             <option value="1"
                                 {{ old('aktif', $pengadu->aktif) == '1' ? 'selected' : '' }}>
                                 Aktif
                             </option>

                             <option value="0"
                                 {{ old('aktif', $pengadu->aktif) == '0' ? 'selected' : '' }}>
                                 Tidak Aktif
                             </option>
                         </select>
                     </div>

                     <div class="col-12">
                         <label class="form-label">Alamat</label>

                         <textarea name="alamat"
                             class="form-control"
                             placeholder="Masukkan alamat lengkap">{{ old('alamat', $pengadu->alamat) }}</textarea>
                     </div>

                 </div>
             </div>
         </div>

         {{-- INFORMASI AKUN --}}
         <div class="form-card">

             <div class="form-card-header">
                 <h5>Informasi Akun</h5>
                 <p>Perbarui username atau password jika diperlukan.</p>
             </div>

             <div class="form-card-body">
                 <div class="row g-3">

                     <div class="col-md-6">
                         <label class="form-label">
                             Username <span class="required">*</span>
                         </label>

                         <input type="text"
                             name="username"
                             class="form-control"
                             value="{{ old('username', $pengadu->username) }}"
                             placeholder="Masukkan username"
                             required>
                     </div>

                     <div class="col-md-6">
                         <label class="form-label">Password Baru</label>

                         <input type="password"
                             name="password"
                             class="form-control"
                             placeholder="Kosongkan jika tidak ingin mengubah password">

                         <div class="form-text">
                             Isi hanya jika ingin mengganti password.
                         </div>
                     </div>

                     <div class="col-md-6">
                         <label class="form-label">Konfirmasi Password Baru</label>

                         <input type="password"
                             name="password_confirmation"
                             class="form-control"
                             placeholder="Ulangi password baru">
                     </div>

                 </div>
             </div>
         </div>

         {{-- TOMBOL --}}
         <div class="form-card">
             <div class="form-actions">

                 <a href="{{ route('admin.pengadu.index') }}" class="btn-back">
                     Kembali
                 </a>

                 <button type="submit" class="btn-save">
                     Simpan Perubahan
                 </button>

             </div>
         </div>

     </form>
 </div>

 @endsection