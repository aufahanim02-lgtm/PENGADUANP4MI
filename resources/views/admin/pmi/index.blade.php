 @extends('layouts.appadmin')

 @section('page-title', 'Data PMI')

 @section('content')

 <style>
     .pmi-page {
         padding: 8px 0 30px;
         color: #334155;
     }

     .pmi-heading {
         margin-bottom: 25px;
     }

     .pmi-heading h3 {
         color: #172554;
         font-size: 25px;
         font-weight: 800;
         margin-bottom: 7px;
     }

     .pmi-heading p {
         color: #64748b;
         font-size: 14px;
         margin: 0;
     }

     .stat-card {
         background: #fff;
         border: 1px solid #e2e8f0;
         border-radius: 14px;
         padding: 21px;
         height: 100%;
         box-shadow: 0 3px 12px rgba(15, 23, 42, .035);
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

     .icon-purple {
         background: #f5f3ff;
         color: #7c3aed;
     }

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

     .pmi-name {
         color: #172554;
         font-weight: 700;
         margin-bottom: 4px;
     }

     .pmi-nik {
         color: #94a3b8;
         font-size: 12px;
     }

     .badge-gender {
         display: inline-block;
         padding: 6px 10px;
         border-radius: 20px;
         font-size: 11px;
         font-weight: 700;
         background: #eff6ff;
         color: #2563eb;
         white-space: nowrap;
     }

     .badge-status {
         display: inline-block;
         padding: 6px 11px;
         border-radius: 20px;
         font-size: 11px;
         font-weight: 700;
         background: #dcfce7;
         color: #15803d;
         white-space: nowrap;
     }

     .badge-status.empty {
         background: #f1f5f9;
         color: #64748b;
     }

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
         width: 350px;
         max-width: 100%;
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

     .action-group {
         display: flex;
         align-items: center;
         justify-content: center;
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
         white-space: nowrap;
         transition: .2s ease;
     }

     .btn-detail {
         background: #eff6ff;
         color: #2563eb;
     }

     .btn-action:hover {
         transform: translateY(-2px);
         filter: brightness(.96);
         color: #1d4ed8;
     }

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

     .pagination-area {
         padding: 17px 23px;
         border-top: 1px solid #f1f5f9;
     }

     .pagination-area nav {
         display: flex;
         justify-content: flex-end;
     }

     .pengadu-name {
         color: #334155;
         font-weight: 600;
     }

     .alert {
         border: none;
         border-radius: 10px;
         font-size: 13px;
     }

     @media (max-width: 768px) {
         .pmi-heading h3 {
             font-size: 22px;
         }

         .table-header,
         .filter-area {
             padding: 17px;
         }

         .stat-value {
             font-size: 24px;
         }

         .filter-form {
             flex-direction: column;
             align-items: stretch;
         }

         .search-input,
         .btn-search,
         .btn-reset {
             width: 100%;
         }

         .pagination-area nav {
             justify-content: center;
         }
     }
 </style>

 <div class="pmi-page">

     {{-- HEADER --}}
     <div class="pmi-heading">
         <h3>Data PMI</h3>
         <p>
             Kelola data Pekerja Migran Indonesia yang terdaftar
             dalam aplikasi Pengaduan P4MI.
         </p>
     </div>

     {{-- NOTIFIKASI --}}
     @if(session('success'))
     <div class="alert alert-success alert-dismissible fade show" role="alert">
         <i class="fas fa-check-circle me-2"></i>
         {{ session('success') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
     </div>
     @endif

     @if(session('error'))
     <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
                         <div class="stat-label">Total PMI</div>
                         <h4 class="stat-value">
                             {{ number_format($totalPmi, 0, ',', '.') }}
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
                         <div class="stat-label">PMI Laki-laki</div>
                         <h4 class="stat-value">
                             {{ number_format($totalLakiLaki, 0, ',', '.') }}
                         </h4>
                     </div>
                     <div class="stat-icon icon-green">
                         <i class="fas fa-male"></i>
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-md-4">
             <div class="stat-card">
                 <div class="d-flex justify-content-between align-items-center">
                     <div>
                         <div class="stat-label">PMI Perempuan</div>
                         <h4 class="stat-value">
                             {{ number_format($totalPerempuan, 0, ',', '.') }}
                         </h4>
                     </div>
                     <div class="stat-icon icon-purple">
                         <i class="fas fa-female"></i>
                     </div>
                 </div>
             </div>
         </div>

     </div>

     {{-- TABEL DATA --}}
     <div class="table-card">

         <div class="table-header">
             <h5>
                 <i class="fas fa-id-card me-2 text-primary"></i>
                 Daftar Pekerja Migran Indonesia
             </h5>
             <small>
                 Informasi PMI yang terdaftar melalui akun Pengadu.
             </small>
         </div>

         {{-- PENCARIAN --}}
         <div class="filter-area">
             <form action="{{ route('admin.pmi.index') }}" method="GET" class="filter-form">

                 <input
                     type="text"
                     name="cari"
                     class="filter-control search-input"
                     placeholder="Cari nama, NIK, negara, perusahaan, atau pengadu..."
                     value="{{ request('cari') }}">

                 <button type="submit" class="btn-search">
                     <i class="fas fa-search"></i>
                     Cari
                 </button>

                 <a href="{{ route('admin.pmi.index') }}" class="btn-reset">
                     <i class="fas fa-sync-alt"></i>
                     Reset
                 </a>

             </form>
         </div>

         {{-- TABEL --}}
         <div class="table-responsive">
             <table class="table">

                 <thead>
                     <tr>
                         <th width="55">No.</th>
                         <th>Nama PMI</th>
                         <th>Jenis Kelamin</th>
                         <th>Tanggal Lahir</th>
                         <th>Negara</th>
                         <th>Perusahaan</th>
                         <th>Status PMI</th>
                         <th>Nama Pengadu</th>
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
                             <div class="pmi-name">
                                 {{ $item->nama }}
                             </div>
                             <div class="pmi-nik">
                                 NIK: {{ $item->nik ?: '-' }}
                             </div>
                         </td>

                         <td>
                             @if($item->jeniskelamin)
                             <span class="badge-gender">
                                 {{ $item->jeniskelamin }}
                             </span>
                             @else
                             -
                             @endif
                         </td>

                         <td>
                             {{ $item->tanggallahir
                                    ? \Carbon\Carbon::parse($item->tanggallahir)->format('d-m-Y')
                                    : '-' }}
                         </td>

                         <td>{{ $item->negara ?: '-' }}</td>

                         <td>{{ $item->perusahaan ?: '-' }}</td>

                         <td>
                             @if($item->statuspmi)
                             <span class="badge-status">
                                 {{ $item->statuspmi }}
                             </span>
                             @else
                             <span class="badge-status empty">
                                 Belum diisi
                             </span>
                             @endif
                         </td>

                         <td>
                             <div class="pengadu-name">
                                 {{ $item->pengadu->nama ?? '-' }}
                             </div>
                         </td>

                         <td>
                             <div class="action-group">
                                 <a href="{{ route('admin.pmi.show', $item->idpmi) }}"
                                     class="btn-action btn-detail">
                                     Detail
                                 </a>
                             </div>
                         </td>

                     </tr>

                     @empty

                     <tr>
                         <td colspan="9" class="empty-state">

                             <div class="empty-icon">
                                 <i class="fas fa-id-card"></i>
                             </div>

                             <strong>
                                 @if(request()->filled('cari'))
                                 Data PMI Tidak Ditemukan
                                 @else
                                 Belum Ada Data PMI
                                 @endif
                             </strong>

                             <small>
                                 @if(request()->filled('cari'))
                                 Coba gunakan kata kunci pencarian yang lain.
                                 @else
                                 Data PMI belum tersedia di dalam database.
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