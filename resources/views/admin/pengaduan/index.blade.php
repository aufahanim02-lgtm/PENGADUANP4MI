 @extends('layouts.appadmin')

 @section('page-title', 'Data Pengaduan')

 @section('content')

 <style>
     .pengaduan-page {
         padding: 10px 0 30px;
     }

     .pengaduan-heading {
         margin-bottom: 25px;
     }

     .pengaduan-heading h3 {
         color: #172554;
         font-size: 25px;
         font-weight: 800;
         margin-bottom: 7px;
     }

     .pengaduan-heading p {
         color: #64748b;
         margin: 0;
     }

     .stat-grid {
         display: grid;
         grid-template-columns: repeat(4, minmax(0, 1fr));
         gap: 16px;
         margin-bottom: 25px;
     }

     .stat-card {
         background: #fff;
         border: 1px solid #e2e8f0;
         border-radius: 14px;
         padding: 20px;
         box-shadow: 0 3px 12px rgba(15, 23, 42, .04);
     }

     .stat-card span {
         display: block;
         color: #64748b;
         font-size: 13px;
         margin-bottom: 9px;
     }

     .stat-card h3 {
         color: #172554;
         font-size: 27px;
         font-weight: 800;
         margin: 0;
     }

     .stat-card.total {
         border-left: 4px solid #2563eb;
     }

     .stat-card.waiting {
         border-left: 4px solid #f59e0b;
     }

     .stat-card.process {
         border-left: 4px solid #0ea5e9;
     }

     .stat-card.done {
         border-left: 4px solid #16a34a;
     }

     .content-card {
         background: #fff;
         border: 1px solid #e2e8f0;
         border-radius: 15px;
         overflow: hidden;
         box-shadow: 0 3px 12px rgba(15, 23, 42, .04);
     }

     .content-card-header {
         padding: 20px;
         border-bottom: 1px solid #e2e8f0;
     }

     .content-card-header h5 {
         color: #172554;
         font-weight: 800;
         margin: 0 0 5px;
     }

     .content-card-header p {
         color: #64748b;
         font-size: 13px;
         margin: 0;
     }

     .filter-area {
         display: flex;
         gap: 10px;
         flex-wrap: wrap;
         margin-top: 18px;
     }

     .filter-area input,
     .filter-area select {
         min-height: 42px;
         border: 1px solid #cbd5e1;
         border-radius: 8px;
         padding: 8px 12px;
         color: #334155;
         outline: none;
     }

     .filter-area input {
         flex: 1;
         min-width: 220px;
     }

     .filter-area input:focus,
     .filter-area select:focus {
         border-color: #2563eb;
         box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
     }

     .btn-filter {
         background: #1d4ed8;
         color: #fff;
         border: 0;
         border-radius: 8px;
         padding: 9px 17px;
         font-weight: 600;
     }

     .btn-reset {
         background: #f1f5f9;
         color: #334155;
         border-radius: 8px;
         padding: 9px 15px;
         text-decoration: none;
         font-weight: 600;
     }

     .table-responsive {
         width: 100%;
         overflow-x: auto;
     }

     .pengaduan-table {
         width: 100%;
         border-collapse: collapse;
         min-width: 950px;
     }

     .pengaduan-table th {
         background: #f8fafc;
         color: #475569;
         font-size: 12px;
         text-transform: uppercase;
         letter-spacing: .4px;
         padding: 15px;
         text-align: left;
         white-space: nowrap;
     }

     .pengaduan-table td {
         padding: 15px;
         border-top: 1px solid #e2e8f0;
         color: #334155;
         font-size: 13px;
         vertical-align: middle;
     }

     .ticket-number {
         color: #1d4ed8;
         font-weight: 700;
     }

     .complaint-title {
         color: #172554;
         font-weight: 700;
         margin-bottom: 4px;
     }

     .muted-text {
         color: #64748b;
         font-size: 12px;
     }

     .status-badge {
         display: inline-block;
         padding: 6px 10px;
         border-radius: 20px;
         font-size: 11px;
         font-weight: 700;
         white-space: nowrap;
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

     .btn-detail {
         display: inline-block;
         background: #eff6ff;
         color: #1d4ed8;
         padding: 7px 12px;
         border-radius: 7px;
         text-decoration: none;
         font-size: 12px;
         font-weight: 700;
         transition: .2s;
     }

     .btn-detail:hover {
         background: #1d4ed8;
         color: #fff;
     }

     .empty-data {
         padding: 45px 20px !important;
         text-align: center;
         color: #64748b !important;
     }

     .pagination-area {
         padding: 18px 20px;
         border-top: 1px solid #e2e8f0;
     }

     @media (max-width: 900px) {
         .stat-grid {
             grid-template-columns: repeat(2, minmax(0, 1fr));
         }
     }

     @media (max-width: 500px) {
         .stat-grid {
             grid-template-columns: 1fr;
         }

         .filter-area input,
         .filter-area select,
         .filter-area button {
             width: 100%;
         }
     }
 </style>

 <div class="pengaduan-page">

     <div class="pengaduan-heading">
         <h3>Data Pengaduan</h3>
         <p>Kelola dan pantau seluruh laporan pengaduan pekerja migran Indonesia.</p>
     </div>

     {{-- STATISTIK --}}
     <div class="stat-grid">

         <div class="stat-card total">
             <span>Total Pengaduan</span>
             <h3>{{ $totalPengaduan }}</h3>
         </div>

         <div class="stat-card waiting">
             <span>Menunggu Verifikasi</span>
             <h3>{{ $menunggu }}</h3>
         </div>

         <div class="stat-card process">
             <span>Sedang Diproses</span>
             <h3>{{ $diproses }}</h3>
         </div>

         <div class="stat-card done">
             <span>Selesai</span>
             <h3>{{ $selesai }}</h3>
         </div>

     </div>

     {{-- TABEL PENGADUAN --}}
     <div class="content-card">

         <div class="content-card-header">
             <h5>Daftar Seluruh Pengaduan</h5>
             <p>Informasi laporan yang masuk ke dalam sistem Pengaduan P4MI.</p>

             {{-- PENCARIAN DAN FILTER --}}
             <form action="{{ route('admin.pengaduan.index') }}" method="GET" class="filter-area">

                 <input
                     type="text"
                     name="cari"
                     placeholder="Cari nomor tiket, judul, atau nama pengadu..."
                     value="{{ request('cari') }}">

                 <select name="status">
                     <option value="">Semua Status</option>
                     <option value="menunggu_verifikasi" {{ request('status') == 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                     <option value="diverifikasi" {{ request('status') == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                     <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                     <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                     <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                 </select>

                 <button type="submit" class="btn-filter">
                     Cari
                 </button>

                 <a href="{{ route('admin.pengaduan.index') }}" class="btn-reset">
                     Reset
                 </a>

             </form>
         </div>

         <div class="table-responsive">

             <table class="pengaduan-table">

                 <thead>
                     <tr>
                         <th>No</th>
                         <th>Nomor Tiket</th>
                         <th>Pengadu</th>
                         <th>Judul Pengaduan</th>
                         <th>Kategori</th>
                         <th>Petugas</th>
                         <th>Status</th>
                         <th>Tanggal Masuk</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>

                 <tbody>

                     @forelse ($data as $key => $item)

                     <tr>
                         <td>{{ $data->firstItem() + $key }}</td>

                         <td>
                             <span class="ticket-number">
                                 {{ $item->nomor_tiket ?? '-' }}
                             </span>
                         </td>

                         <td>
                             <strong>{{ $item->pengadu->nama ?? '-' }}</strong>
                         </td>

                         <td>
                             <div class="complaint-title">
                                 {{ $item->judul }}
                             </div>
                         </td>

                         <td>
                             {{ $item->kategori->nama ?? '-' }}
                         </td>

                         <td>
                             {{ $item->petugas->nama ?? 'Belum ditugaskan' }}
                         </td>

                         <td>
                             @php
                             $status = $item->status ?? '';
                             $labelStatus = [
                             'menunggu_verifikasi' => 'Menunggu Verifikasi',
                             'diverifikasi' => 'Diverifikasi',
                             'diproses' => 'Diproses',
                             'selesai' => 'Selesai',
                             'ditolak' => 'Ditolak',
                             ];
                             @endphp

                             <span class="status-badge status-{{ $status }}">
                                 {{ $labelStatus[$status] ?? ucfirst(str_replace('_', ' ', $status)) }}
                             </span>
                         </td>

                         <td>
                             {{ $item->created_at ? $item->created_at->format('d-m-Y') : '-' }}
                         </td>

                         <td>
                             <a
                                 href="{{ route('admin.pengaduan.show', $item->idpengaduan) }}"
                                 class="btn-detail">
                                 Detail
                             </a>
                         </td>
                     </tr>

                     @empty

                     <tr>
                         <td colspan="9" class="empty-data">
                             <strong>Belum ada data pengaduan.</strong>
                             <br>
                             Data pengaduan yang masuk akan ditampilkan di sini.
                         </td>
                     </tr>

                     @endforelse

                 </tbody>

             </table>

         </div>

         {{-- PAGINATION --}}
         <div class="pagination-area">
             {{ $data->links() }}
         </div>

     </div>

 </div>

 @endsection