<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ModelPengaduan;

class ControllerDashboardPengadu extends Controller
{
    public function index()
    {
        $idpengadu = auth('pengadu')->id();

        // Ringkasan pengaduan
        $jumlahPengaduan = ModelPengaduan::where('idpengadu', $idpengadu)
            ->count();

        $jumlahMenunggu = ModelPengaduan::where('idpengadu', $idpengadu)
            ->where('status', 'menunggu_verifikasi')
            ->count();

        $jumlahDiproses = ModelPengaduan::where('idpengadu', $idpengadu)
            ->where('status', 'diproses')
            ->count();

        $jumlahSelesai = ModelPengaduan::where('idpengadu', $idpengadu)
            ->where('status', 'selesai')
            ->count();

        $jumlahDitolak = ModelPengaduan::where('idpengadu', $idpengadu)
            ->where('status', 'ditolak')
            ->count();

        // Lima pengaduan terbaru
        $pengaduanTerbaru = ModelPengaduan::with([
            'kategori',
            'wilayah',
            'pmi',
            'bukti'
        ])
            ->where('idpengadu', $idpengadu)
            ->latest('idpengaduan')
            ->take(5)
            ->get();

        return view('pengadu.dashboard.dashboardpengadu', compact(
            'jumlahPengaduan',
            'jumlahMenunggu',
            'jumlahDiproses',
            'jumlahSelesai',
            'jumlahDitolak',
            'pengaduanTerbaru'
        ));
    }
}
