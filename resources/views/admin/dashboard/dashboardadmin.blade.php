@extends('layouts.appadmin')

@section('title', 'Dashboard Admin - Pengaduan P4MI')

@section('page-title', 'Dashboard Admin')

@section('content')

<div class="welcome">

    <h2>
        Selamat datang,
        {{ auth('user')->user()->nama ?? 'Administrator' }} 👋
    </h2>

    <p>
        Kelola data pengguna, pengaduan, kategori, wilayah,
        dan laporan melalui dashboard administrator.
    </p>

</div>


<div class="stats-grid">

    <div class="stat-card">

        <div class="stat-info">

            <span>
                Total Pengadu
            </span>

            <h3>
                {{ $jumlahPengadu }}
            </h3>

        </div>

        <div class="stat-icon">
            👤
        </div>

    </div>


    <div class="stat-card">

        <div class="stat-info">

            <span>
                Total Pengaduan
            </span>

            <h3>
                {{ $jumlahPengaduan }}
            </h3>

        </div>

        <div class="stat-icon">
            📋
        </div>

    </div>


    <div class="stat-card">

        <div class="stat-info">

            <span>
                Sedang Diproses
            </span>

            <h3>
                {{ $jumlahDiproses }}
            </h3>

        </div>

        <div class="stat-icon">
            ⚙
        </div>

    </div>


    <div class="stat-card">

        <div class="stat-info">

            <span>
                Pengaduan Selesai
            </span>

            <h3>
                {{ $jumlahSelesai }}
            </h3>

        </div>

        <div class="stat-icon">
            ✓
        </div>

    </div>

</div>


<div class="dashboard-grid">


    <div class="card">

        <div class="card-header">

            <h3>
                Pengaduan Terbaru
            </h3>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            Pengadu
                        </th>

                        <th>
                            Judul
                        </th>

                        <th>
                            Kategori
                        </th>

                        <th>
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($pengaduanTerbaru as $item)

                    <tr>

                        <td>
                            <strong>
                                {{ $item->pengadu->nama ?? '-' }}
                            </strong>
                        </td>

                        <td>
                            {{ \Illuminate\Support\Str::limit($item->judul, 35) }}
                        </td>

                        <td>
                            {{ $item->kategori->namakategori ?? '-' }}
                        </td>

                        <td>

                            @php

                            $statusClass = match($item->status) {

                            'diajukan'
                            => 'status-diajukan',

                            'diverifikasi'
                            => 'status-diverifikasi',

                            'diproses'
                            => 'status-diproses',

                            'selesai'
                            => 'status-selesai',

                            'ditolak'
                            => 'status-ditolak',

                            default => '',

                            };

                            @endphp


                            <span class="status {{ $statusClass }}">

                                {{ ucfirst($item->status) }}

                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="4"
                            class="empty">

                            Belum ada pengaduan.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    <div class="card">

        <div class="card-header">

            <h3>
                Status Pengaduan
            </h3>

        </div>


        <div class="status-summary">

            @php

            $total = $jumlahPengaduan > 0
            ? $jumlahPengaduan
            : 1;

            $statusData = [

            [
            'nama' => 'Diajukan',
            'jumlah' => $jumlahDiajukan
            ],

            [
            'nama' => 'Diverifikasi',
            'jumlah' => $jumlahDiverifikasi
            ],

            [
            'nama' => 'Diproses',
            'jumlah' => $jumlahDiproses
            ],

            [
            'nama' => 'Selesai',
            'jumlah' => $jumlahSelesai
            ],

            [
            'nama' => 'Ditolak',
            'jumlah' => $jumlahDitolak
            ],

            ];

            @endphp


            @foreach ($statusData as $status)

            <div class="status-item">

                <div class="status-item-header">

                    <span>
                        {{ $status['nama'] }}
                    </span>

                    <strong>
                        {{ $status['jumlah'] }}
                    </strong>

                </div>


                <div class="progress">

                    <div class="progress-bar"
                        style="
                                    width:
                                    {{ ($status['jumlah'] / $total) * 100 }}%
                                 ">
                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</div>


<div class="card category-card">

    <div class="card-header">

        <h3>
            Pengaduan Berdasarkan Kategori
        </h3>

    </div>


    <div class="category-list">

        @forelse ($kategori as $item)

        <div class="category-item">

            <span>
                {{ $item->namakategori }}
            </span>

            <span class="category-count">
                {{ $item->pengaduan_count }}
            </span>

        </div>

        @empty

        <div class="empty">

            Belum ada data kategori pengaduan.

        </div>

        @endforelse

    </div>

</div>


<style>
    .welcome {
        background: linear-gradient(135deg,
                #0d6efd,
                #185abc);

        color: white;
        border-radius: 16px;
        padding: 25px 28px;
        margin-bottom: 25px;
    }

    .welcome h2 {
        font-size: 22px;
        margin-bottom: 6px;
    }

    .welcome p {
        font-size: 13px;
        opacity: 0.9;
    }


    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: white;
        border: 1px solid #e7ebf2;
        border-radius: 14px;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-info span {
        display: block;
        color: #7b8494;
        font-size: 12px;
        margin-bottom: 7px;
    }

    .stat-info h3 {
        font-size: 27px;
    }

    .stat-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: #eaf2ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }


    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
    }


    .card {
        overflow: hidden;
    }


    .card-header {
        padding: 19px 20px;
        border-bottom: 1px solid #edf0f5;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h3 {
        font-size: 15px;
    }


    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: #f8fafc;
        color: #718096;
        font-size: 11px;
        text-align: left;
        padding: 12px 15px;
        white-space: nowrap;
    }

    td {
        padding: 14px 15px;
        border-top: 1px solid #edf0f5;
        font-size: 12px;
        color: #4b5565;
    }

    td strong {
        color: #172033;
    }

    .empty {
        text-align: center;
        padding: 35px;
        color: #8a94a6;
    }


    .status {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 50px;
        font-size: 10px;
        font-weight: bold;
    }

    .status-diajukan {
        background: #fff4d6;
        color: #9a6700;
    }

    .status-diverifikasi {
        background: #eaf2ff;
        color: #0d6efd;
    }

    .status-diproses {
        background: #e9f5ff;
        color: #087990;
    }

    .status-selesai {
        background: #e8f7ef;
        color: #198754;
    }

    .status-ditolak {
        background: #fdecec;
        color: #dc3545;
    }


    .status-summary {
        padding: 20px;
    }

    .status-item {
        margin-bottom: 18px;
    }

    .status-item:last-child {
        margin-bottom: 0;
    }

    .status-item-header {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        margin-bottom: 7px;
    }

    .progress {
        height: 7px;
        background: #edf0f5;
        border-radius: 20px;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        background: #0d6efd;
        border-radius: 20px;
    }


    .category-card {
        margin-top: 20px;
    }

    .category-list {
        padding: 20px;
    }

    .category-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 11px 0;
        border-bottom: 1px solid #edf0f5;
        font-size: 12px;
    }

    .category-item:last-child {
        border-bottom: none;
    }

    .category-count {
        background: #eaf2ff;
        color: #0d6efd;
        padding: 4px 8px;
        border-radius: 20px;
        font-weight: bold;
    }


    @media (max-width: 1100px) {

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }

    }


    @media (max-width: 500px) {

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .welcome {
            padding: 20px;
        }

        .welcome h2 {
            font-size: 19px;
        }

    }
</style>

@endsection