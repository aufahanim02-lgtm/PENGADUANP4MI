<?php

namespace App\Http\Controllers\Tindaklanjut;

use App\Http\Controllers\Controller;
use App\Models\ModelTindaklanjut;
use Illuminate\Http\Request;

class ControllerTindaklanjutAdmin extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX - DAFTAR SELURUH TINDAK LANJUT
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = ModelTindaklanjut::with([
            'pengaduan.pengadu',
            'pengaduan.kategori',
            'pengaduan.pmi',
            'petugas',
        ]);

        // Pencarian
        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('keterangan', 'like', "%{$cari}%")
                    ->orWhereHas('petugas', function ($petugas) use ($cari) {
                        $petugas->where('nama', 'like', "%{$cari}%");
                    })
                    ->orWhereHas('pengaduan', function ($pengaduan) use ($cari) {
                        $pengaduan->where('nomor_tiket', 'like', "%{$cari}%")
                            ->orWhere('judul', 'like', "%{$cari}%")
                            ->orWhereHas('pengadu', function ($pengadu) use ($cari) {
                                $pengadu->where('nama', 'like', "%{$cari}%");
                            });
                    });
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $data = $query
            ->latest('idtindaklanjut')
            ->paginate(10)
            ->withQueryString();

        // Statistik
        $totalTindaklanjut = ModelTindaklanjut::count();

        $totalDiproses = ModelTindaklanjut::where(
            'status',
            'diproses'
        )->count();

        $totalSelesai = ModelTindaklanjut::where(
            'status',
            'selesai'
        )->count();

        $totalDitolak = ModelTindaklanjut::where(
            'status',
            'ditolak'
        )->count();

        return view(
            'admin.tindaklanjut.index',
            compact(
                'data',
                'totalTindaklanjut',
                'totalDiproses',
                'totalSelesai',
                'totalDitolak'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW - DETAIL TINDAK LANJUT
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $tindaklanjut = ModelTindaklanjut::with([
            'pengaduan.pengadu',
            'pengaduan.kategori',
            'pengaduan.pmi',
            'pengaduan.wilayah',
            'petugas',
        ])->findOrFail($id);

        return view(
            'admin.tindaklanjut.show',
            compact('tindaklanjut')
        );
    }
}
