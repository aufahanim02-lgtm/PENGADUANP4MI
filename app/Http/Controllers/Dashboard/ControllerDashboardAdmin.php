<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ModelUser;
use App\Models\ModelPengadu;
use App\Models\ModelKategori;
use App\Models\ModelWilayah;
use App\Models\ModelPmi;
use App\Models\ModelPengaduan;
use App\Models\ModelNotifikasi;

class ControllerDashboardAdmin extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | STATISTIK USER
        |--------------------------------------------------------------------------
        */

        $totalUser = ModelUser::count();

        $totalAdmin = ModelUser::where('role', 'admin')->count();

        $totalPetugas = ModelUser::where('role', 'petugas')->count();

        $totalPengadu = ModelPengadu::count();


        /*
        |--------------------------------------------------------------------------
        | STATISTIK DATA MASTER
        |--------------------------------------------------------------------------
        */

        $totalKategori = ModelKategori::count();

        $totalWilayah = ModelWilayah::count();

        $totalPmi = ModelPmi::count();


        /*
        |--------------------------------------------------------------------------
        | STATISTIK PENGADUAN
        |--------------------------------------------------------------------------
        */

        $totalPengaduan = ModelPengaduan::count();

        $pengaduanMenunggu = ModelPengaduan::where(
            'status',
            'menunggu_verifikasi'
        )->count();

        $pengaduanDiverifikasi = ModelPengaduan::where(
            'status',
            'diverifikasi'
        )->count();

        $pengaduanDiproses = ModelPengaduan::where(
            'status',
            'diproses'
        )->count();

        $pengaduanSelesai = ModelPengaduan::where(
            'status',
            'selesai'
        )->count();

        $pengaduanDitolak = ModelPengaduan::where(
            'status',
            'ditolak'
        )->count();
        $pengaduanPerluPerbaikan = ModelPengaduan::where(
            'status',
            'perlu_perbaikan'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | PENGADUAN TERBARU
        |--------------------------------------------------------------------------
        */

        $pengaduanTerbaru = ModelPengaduan::with([
            'pengadu',
            'kategori',
            'petugas',
        ])
            ->orderByDesc('created_at')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | STATISTIK NOTIFIKASI
        |--------------------------------------------------------------------------
        */

        $totalNotifikasi = ModelNotifikasi::count();

        $notifikasiBelumDibaca = ModelNotifikasi::where(
            'dibaca',
            false
        )->count();


        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view('admin.dashboardadmin', compact(
            'totalUser',
            'totalAdmin',
            'totalPetugas',
            'totalPengadu',
            'totalKategori',
            'totalWilayah',
            'totalPmi',
            'totalPengaduan',
            'pengaduanMenunggu',
            'pengaduanDiverifikasi',
            'pengaduanDiproses',
            'pengaduanSelesai',
            'pengaduanDitolak',
            'pengaduanTerbaru',
            'totalNotifikasi',
            'notifikasiBelumDibaca',
            'pengaduanPerluPerbaikan',
        ));
    }
}
