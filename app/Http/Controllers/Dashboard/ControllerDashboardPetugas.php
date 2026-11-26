<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ModelPengaduan;

class ControllerDashboardPetugas extends Controller
{
    public function index()
    {
        // Mengambil data petugas yang sedang login
        $petugas = auth('user')->user();

        // Query dasar pengaduan
        // Tidak menggunakan iduser karena kolom tersebut
        // tidak tersedia pada tabel pengaduan
        $query = ModelPengaduan::query();

        // Statistik seluruh pengaduan
        $totalPengaduan = (clone $query)->count();

        $totalMenunggu = (clone $query)
            ->where('status', 'menunggu_verifikasi')
            ->count();

        $totalDiproses = (clone $query)
            ->where('status', 'diproses')
            ->count();

        $totalSelesai = (clone $query)
            ->where('status', 'selesai')
            ->count();

        $totalDitolak = (clone $query)
            ->where('status', 'ditolak')
            ->count();

        // Mengambil 5 pengaduan terbaru
        $pengaduanTerbaru = (clone $query)
            ->with([
                'pengadu',
                'kategori',
                'pmi'
            ])
            ->latest()
            ->take(5)
            ->get();

        // Mengirim data ke halaman dashboard Petugas
        return view('petugas.dashboard.dashboardpetugas', compact(
            'petugas',
            'totalPengaduan',
            'totalMenunggu',
            'totalDiproses',
            'totalSelesai',
            'totalDitolak',
            'pengaduanTerbaru'
        ));
    }
}
