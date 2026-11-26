 @extends('layouts.appadmin')

 @section('page-title', 'Data Pengadu')

 @section('content')

 <style>
     .pengadu-page {
         padding: 8px 0 30px;
         color: #334155;
     }

     .pengadu-heading {
         margin-bottom: 25px;
     }

     .pengadu-heading h3 {
         color: #172554;
         font-size: 25px;
         font-weight: 800;
         margin-bottom: 7px;
     }

     .pengadu-heading p {
         color: #64748b;
         font-size: 14px;
         margin: 0;
     }

     /* STATISTIK */
     .stat-card {
         background: #fff;
         border: 1px solid #e2e8f0;
         border-radius: 14px;
         padding: 21px;
         height: 100%;
         box-shadow: 0 3px 12px rgba(15, 23, 42, .035);
         transition: .2s ease;
     }

     .stat-card:hover {
         transform: translateY(-3px);
         box-shadow: 0 7px 18px rgba(15, 23, 42, .07);
     }

     .stat-label {
         color: #64748b;
         font-size: 13px;
         font-weight: 600;
         margin-bottom: 9px;
     }

     .stat-value {
         color: #172554;
         font-size: 28px;
         font-weight: 800;
         margin: 0;
     }

     .stat-icon {
         width: 46px;
         height: 46px;
         display: flex;
         align-items: center;
         justify-content: center;
         border-radius: 12px;
         font-size: 20px;
     }

     .icon-blue {
         background: #eff6ff;
         color: #2563eb;
     }

     .icon-green {
         background: #f0fdf4;
         color: #16a34a;
     }

     .icon-red {
         background: #fef2f2;
         color: #dc2626;
     }

     /* TABEL CARD */
     .table-card {
         background: #fff;
         border: 1px solid #e2e8f0;
         border-radius: 14px;
         overflow: hidden;
         box-shadow: 0 3px 12px rgba(15, 23, 42, .035);
     }

     .table-header {
         padding: 21px 23px;
         border-bottom: 1px solid #e2e8f0;
     }

     .table-header h5 {
         color: #172554;
         font-size: 16px;
         font-weight: 800;
         margin: 0 0 5px;
     }

     .table-header small {
         color: #94a3b8;
         font-size: 12px;
     }

     /* TOMBOL TAMBAH */
     .btn-add {
         display: inline-flex;
         align-items: center;
         justify-content: center;
         gap: 8px;
         background: #2563eb;
         color: #fff;
         border: none;
         border-radius: 9px;
         padding: 11px 17px;
         font-size: 13px;
         font-weight: 700;
         text-decoration: none;
         transition: .2s ease;
     }

     .btn-add:hover {
         background: #1d4ed8;
         color: #fff;
         transform: translateY(-1px);
     }

     /* FILTER */
     .filter-area {
         padding: 17px 23px;
         background: #f8fafc;
         border-bottom: 1px solid #e2e8f0;
     }

     .filter-form {
         display: flex;
         align-items: center;
         flex-wrap: wrap;
         gap: 9px;
     }

     .filter-control {
         min-height: 42px;
         border: 1px solid #cbd5e1;
         border-radius: 8px;
         background: #fff;
         color: #334155;
         padding: 8px 12px;
         font-size: 13px;
         outline: none;
     }

     .filter-control:focus {
         border-color: #3b82f6;
         box-shadow: 0 0 0 3px rgba(59, 130, 246, .1);
     }

     .search-input {
         width: 320px;
         max-width: 100%;
     }

     .status-select {
         width: 175px;
     }

     .btn-search,
     .btn-reset {
         min-height: 42px;
         display: inline-flex;
         align-items: center;
         justify-content: center;
         gap: 7px;
         border-radius: 8px;
         padding: 9px 15px;
         font-size: 13px;
         font-weight: 700;
         text-decoration: none;
         cursor: pointer;
         transition: .2s ease;
     }

     .btn-search {
         background: #2563eb;
         color: #fff;
         border: 1px solid #2563eb;
     }

     .btn-search:hover {
         background: #1d4ed8;
         color: #fff;
     }

     .btn-reset {
         background: #fff;
         color: #475569;
         border: 1px solid #cbd5e1;
     }

     .btn-reset:hover {
         background: #f1f5f9;
         color: #1e293b;
     }

     /* TABEL */
     .table {
         margin: 0;
         vertical-align: middle;
     }

     .table thead th {
         background: #f8fafc;
         color: #64748b;
         font-size: 11px;
         font-weight: 800;
         text-transform: uppercase;
         letter-spacing: .35px;
         padding: 15px 14px;
         white-space: nowrap;
         border-bottom: 1px solid #e2e8f0;
     }

     .table tbody td {
         padding: 15px 14px;
         color: #475569;
         font-size: 13px;
         border-bottom: 1px solid #f1f5f9;
     }

     .table tbody tr:last-child td {
         border-bottom: none;
     }

     .table tbody tr:hover {
         background: #f8fafc;
     }

     .number-cell {
         color: #94a3b8 !important;
         font-weight: 600;
     }

     .pengadu-name {
         color: #172554;
         font-weight: 700;
         margin-bottom: 4px;
     }

     .pengadu-username {
         color: #94a3b8;
         font-size: 12px;
     }

     /* BADGE */
     .badge-status {
         display: inline-flex;
         align-items: center;
         gap: 5px;
         padding: 6px 11px;
         border-radius: 20px;
         font-size: 11px;
         font-weight: 700;
         white-space: nowrap;
     }

     .badge-aktif {
         background: #dcfce7;
         color: #15803d;
     }

     .badge-nonaktif {
         background: #fee2e2;
         color: #b91c1c;
     }

     .count-badge {
         display: inline-flex;
         align-items: center;
         justify-content: center;
         min-width: 29px;
         padding: 5px 9px;
         border-radius: 7px;
         font-size: 12px;
         font-weight: 700;
     }

     .count-pmi {
         background: #e0f2fe;
         color: #0369a1;
     }

     .count-pengaduan {
         background: #ede9fe;
         color: #6d28d9;
     }

     /* TOMBOL AKSI */
     .action-group {
         display: flex;
         align-items: center;
         justify-content: center;
         gap: 7px;
         flex-wrap: nowrap;
     }

     .btn-action {
         min-width: 65px;
         min-height: 34px;
         display: inline-flex;
         align-items: center;
         justify-content: center;
         padding: 7px 10px;
         border: none;
         border-radius: 7px;
         text-decoration: none;
         font-size: 11px;
         font-weight: 700;
         cursor: pointer;
         transition: .2s ease;
         white-space: nowrap;
     }

     .btn-detail {
         background: #eff6ff;
         color: #2563eb;
     }

     .btn-edit {
         background: #fffbeb;
         color: #d97706;
     }

     .btn-delete {
         background: #fef2f2;
         color: #dc2626;
     }

     .btn-action:hover {
         transform: translateY(-2px);
         filter: brightness(.96);
     }

     .action-group form {
         margin: 0;
     }

     /* EMPTY STATE */
     .empty-state {
         padding: 55px 15px !important;
         text-align: center;
         color: #64748b !important;
     }

     .empty-icon {
         width: 58px;
         height: 58px;
         margin: 0 auto 13px;
         display: flex;
         align-items: center;
         justify-content: center;
         background: #f1f5f9;
         color: #94a3b8;
         border-radius: 50%;
         font-size: 23px;
     }

     .empty-state strong {
         display: block;
         color: #334155;
         font-size: 14px;
         margin-bottom: 5px;
     }

     .empty-state small {
         color: #94a3b8;
     }

     /* PAGINATION */
     .pagination-area {
         padding: 17px 23px;
         border-top: 1px solid #f1f5f9;
     }

     .pagination-area nav {
         display: flex;
         justify-content: flex-end;
     }

     .pagination-area p {
         margin-bottom: 0;
     }

     .pengadu-alert {
         border: none;
         border-radius: 10px;
         font-size: 13px;
         margin-bottom: 20px;
     }

     /* RESPONSIVE */
     @media (max-width: 768px) {
         .pengadu-heading h3 {
             font-size: 22px;
         }

         .table-header {
             padding: 17px;
         }

         .filter-area {
             padding: 15px 17px;
         }

         .filter-form {
             align-items: stretch;
             flex-direction: column;
         }

         .search-input,
         .status-select,
         .btn-search,
         .btn-reset {
             width: 100%;
         }

         .stat-value {
             font-size: 24px;
         }

         .pagination-area nav {
             justify-content: center;
         }

         .action-group {
             justify-content: flex-start;
         }
     }
 </style>

 <div class="pengadu-page">

     {{-- HEADER HALAMAN --}}
     <div class="pengadu-heading">
         <div>
             <h3>Data Pengadu</h3>
             <p>
                 Kelola seluruh akun masyarakat yang terdaftar
                 dalam aplikasi Pengaduan P4MI.
             </p>
         </div>
     </div>

     {{-- NOTIFIKASI --}}
     @if(session('success'))
     <div class="alert alert-success alert-dismissible fade show pengadu-alert" role="alert">
         <i class="fas fa-check-circle me-2"></i>
         {{ session('success') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
     </div>
     @endif

     @if(session('error'))
     <div class="alert alert-danger alert-dismissible fade show pengadu-alert" role="alert">
         <i class="fas fa-exclamation-circle me-2"></i>
         {{ session('error') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
     </div>
     @endif

     {{-- STATISTIK --}}
     <div class="row g-3 mb-4">

         <div class="col-md-4">
             <div class="stat-card">
                 <div class="d-flex justify-content-between align-items-center">
                     <div>
                         <div class="stat-label">Total Pengadu</div>
                         <h4 class="stat-value">
                             {{ number_format($totalPengadu ?? 0, 0, ',', '.') }}
                         </h4>
                     </div>
                     <div class="stat-icon icon-blue">
                         <i class="fas fa-users"></i>
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-md-4">
             <div class="stat-card">
                 <div class="d-flex justify-content-between align-items-center">
                     <div>
                         <div class="stat-label">Pengadu Aktif</div>
                         <h4 class="stat-value">
                             {{ number_format($pengaduAktif ?? 0, 0, ',', '.') }}
                         </h4>
                     </div>
                     <div class="stat-icon icon-green">
                         <i class="fas fa-user-check"></i>
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-md-4">
             <div class="stat-card">
                 <div class="d-flex justify-content-between align-items-center">
                     <div>
                         <div class="stat-label">Pengadu Nonaktif</div>
                         <h4 class="stat-value">
                             {{ number_format($pengaduNonaktif ?? 0, 0, ',', '.') }}
                         </h4>
                     </div>
                     <div class="stat-icon icon-red">
                         <i class="fas fa-user-times"></i>
                     </div>
                 </div>
             </div>
         </div>

     </div>

     {{-- DAFTAR PENGADU --}}
     <div class="table-card">

         {{-- HEADER TABEL --}}
         <div class="table-header d-flex justify-content-between align-items-center flex-wrap gap-3">
             <div>
                 <h5>
                     <i class="fas fa-users me-2 text-primary"></i>
                     Daftar Pengadu
                 </h5>
                 <small>
                     Informasi akun masyarakat yang terdaftar di sistem.
                 </small>
             </div>

             <a href="{{ route('admin.pengadu.create') }}" class="btn-add">
                 <i class="fas fa-plus"></i>
                 Tambah Pengadu
             </a>
         </div>

         {{-- FILTER DAN PENCARIAN --}}
         <div class="filter-area">
             <form action="{{ route('admin.pengadu.index') }}"
                 method="GET"
                 class="filter-form">

                 <input
                     type="text"
                     name="search"
                     class="filter-control search-input"
                     placeholder="Cari nama, NIK, username, atau HP..."
                     value="{{ request('search') }}">

                 <select name="aktif" class="filter-control status-select">
                     <option value="">Semua Status</option>
                     <option value="1" {{ request('aktif') === '1' ? 'selected' : '' }}>
                         Aktif
                     </option>
                     <option value="0" {{ request('aktif') === '0' ? 'selected' : '' }}>
                         Nonaktif
                     </option>
                 </select>

                 <button type="submit" class="btn-search">
                     <i class="fas fa-search"></i>
                     Cari
                 </button>

                 <a href="{{ route('admin.pengadu.index') }}" class="btn-reset">
                     <i class="fas fa-sync-alt"></i>
                     Reset
                 </a>

             </form>
         </div>

         {{-- TABEL DATA --}}
         <div class="table-responsive">
             <table class="table">

                 <thead>
                     <tr>
                         <th width="55">No.</th>
                         <th>Nama Pengadu</th>
                         <th>NIK</th>
                         <th>No. HP</th>
                         <th class="text-center">Jumlah PMI</th>
                         <th class="text-center">Pengaduan</th>
                         <th>Status</th>
                         <th class="text-center">Aksi</th>
                     </tr>
                 </thead>

                 <tbody>
                     @forelse($data as $item)
                     <tr>

                         <td class="number-cell">
                             {{ $data->firstItem() + $loop->index }}
                         </td>

                         <td>
                             <div class="pengadu-name">
                                 {{ $item->nama }}
                             </div>
                             <div class="pengadu-username">
                                 <i class="fas fa-at me-1"></i>{{ $item->username }}
                             </div>
                         </td>

                         <td>{{ $item->nik ?: '-' }}</td>

                         <td>{{ $item->nohp ?: '-' }}</td>

                         <td class="text-center">
                             <span class="count-badge count-pmi">
                                 {{ $item->pmi_count ?? 0 }}
                             </span>
                         </td>

                         <td class="text-center">
                             <span class="count-badge count-pengaduan">
                                 {{ $item->pengaduan_count ?? 0 }}
                             </span>
                         </td>

                         <td>
                             @if($item->aktif)
                             <span class="badge-status badge-aktif">
                                 <i class="fas fa-check-circle"></i>
                                 Aktif
                             </span>
                             @else
                             <span class="badge-status badge-nonaktif">
                                 <i class="fas fa-times-circle"></i>
                                 Nonaktif
                             </span>
                             @endif
                         </td>

                         {{-- AKSI --}}
                         <td>
                             <div class="action-group">

                                 {{-- DETAIL --}}
                                 <a href="{{ route('admin.pengadu.show', $item->idpengadu) }}"
                                     class="btn-action btn-detail">
                                     Detail
                                 </a>

                                 {{-- EDIT --}}
                                 <a href="{{ route('admin.pengadu.edit', $item->idpengadu) }}"
                                     class="btn-action btn-edit">
                                     Edit
                                 </a>

                                 {{-- NONAKTIFKAN --}}
                                 @if($item->aktif)
                                 <form
                                     action="{{ route('admin.pengadu.destroy', $item->idpengadu) }}"
                                     method="POST"
                                     onsubmit="return confirm('Apakah kamu yakin ingin menonaktifkan akun Pengadu ini?')">

                                     @csrf
                                     @method('DELETE')

                                     <button type="submit" class="btn-action btn-delete">
                                         Nonaktifkan
                                     </button>

                                 </form>
                                 @endif

                             </div>
                         </td>

                     </tr>

                     @empty
                     <tr>
                         <td colspan="8" class="empty-state">

                             <div class="empty-icon">
                                 <i class="fas fa-users"></i>
                             </div>

                             <strong>
                                 @if(request()->filled('search') || request()->filled('aktif'))
                                 Data Pengadu Tidak Ditemukan
                                 @else
                                 Belum Ada Data Pengadu
                                 @endif
                             </strong>

                             <small>
                                 @if(request()->filled('search') || request()->filled('aktif'))
                                 Coba ubah kata kunci pencarian atau filter status.
                                 @else
                                 Silakan tambahkan akun Pengadu terlebih dahulu.
                                 @endif
                             </small>

                         </td>
                     </tr>
                     @endforelse
                 </tbody>

             </table>
         </div>

         {{-- PAGINATION --}}
         @if($data->hasPages())
         <div class="pagination-area">
             {{ $data->links() }}
         </div>
         @endif

     </div>

 </div>

 @endsection