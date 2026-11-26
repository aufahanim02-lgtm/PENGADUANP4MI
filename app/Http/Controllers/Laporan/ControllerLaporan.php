<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\ModelPengaduan;
use App\Models\ModelKategori;
use App\Models\ModelWilayah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ControllerLaporan extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HELPER QUERY LAPORAN
    |--------------------------------------------------------------------------
    */

    private function laporanQuery(array $validated = [])
    {
        $query = ModelPengaduan::with([
            'pengadu',
            'pmi',
            'kategori',
            'wilayah',
        ]);

        // FILTER TANGGAL MULAI
        if (!empty($validated['tanggalmulai'])) {
            $query->whereDate(
                'created_at',
                '>=',
                $validated['tanggalmulai']
            );
        }

        // FILTER TANGGAL AKHIR
        if (!empty($validated['tanggalakhir'])) {
            $query->whereDate(
                'created_at',
                '<=',
                $validated['tanggalakhir']
            );
        }

        // FILTER KATEGORI
        if (!empty($validated['idkategori'])) {
            $query->where(
                'idkategori',
                $validated['idkategori']
            );
        }

        // FILTER WILAYAH
        if (!empty($validated['idwilayah'])) {
            $query->where(
                'idwilayah',
                $validated['idwilayah']
            );
        }

        // FILTER STATUS
        if (!empty($validated['status'])) {
            $query->where(
                'status',
                $validated['status']
            );
        }

        return $query;
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI FILTER LAPORAN
    |--------------------------------------------------------------------------
    */

    private function validasiFilter(Request $request): array
    {
        return $request->validate([
            'tanggalmulai' => [
                'nullable',
                'date',
            ],

            'tanggalakhir' => [
                'nullable',
                'date',
                'after_or_equal:tanggalmulai',
            ],

            'idkategori' => [
                'nullable',
                'exists:kategori,idkategori',
            ],

            'idwilayah' => [
                'nullable',
                'exists:wilayah,idwilayah',
            ],

            'status' => [
                'nullable',
                Rule::in([
                    'menunggu_verifikasi',
                    'diverifikasi',
                    'perlu_perbaikan',
                    'diproses',
                    'selesai',
                    'ditolak',
                ]),
            ],
        ], [
            'tanggalakhir.after_or_equal' =>
                'Tanggal akhir tidak boleh sebelum tanggal mulai.',

            'idkategori.exists' =>
                'Kategori tidak ditemukan.',

            'idwilayah.exists' =>
                'Wilayah tidak ditemukan.',

            'status.in' =>
                'Status pengaduan tidak valid.',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX - MENAMPILKAN LAPORAN
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        // VALIDASI FILTER
        $validated = $this->validasiFilter($request);

        // DATA LAPORAN
        $query = $this->laporanQuery($validated);

        $data = (clone $query)
            ->latest('idpengaduan')
            ->paginate(10)
            ->withQueryString();

        // STATISTIK BERDASARKAN FILTER
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

        // DATA KATEGORI
        // Tidak menggunakan orderBy('nama') karena
        // kolom nama pada tabel kategori belum tersedia.
        $kategori = ModelKategori::query()
            ->orderBy('idkategori')
            ->get();

        // DATA WILAYAH
        $wilayah = ModelWilayah::query()
            ->orderBy('provinsi')
            ->orderBy('kabupaten')
            ->get();

        return view('admin.laporan.index', compact(
            'data',
            'kategori',
            'wilayah',
            'validated',
            'totalPengaduan',
            'totalMenunggu',
            'totalDiproses',
            'totalSelesai',
            'totalDitolak'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | CETAK - MENAMPILKAN DATA LAPORAN UNTUK DICETAK
    |--------------------------------------------------------------------------
    */

    public function cetak(Request $request)
    {
        // VALIDASI FILTER
        $validated = $this->validasiFilter($request);

        // AMBIL SELURUH DATA SESUAI FILTER
        $data = $this->laporanQuery($validated)
            ->latest('idpengaduan')
            ->get();

        return view('admin.laporan.cetak', compact(
            'data',
            'validated'
        ));
    }
}
