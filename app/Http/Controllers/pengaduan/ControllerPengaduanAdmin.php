<?php

namespace App\Http\Controllers\Pengaduan;

use App\Http\Controllers\Controller;
use App\Models\ModelPengaduan;
use App\Models\ModelUser;
use App\Models\ModelNotifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerPengaduanAdmin extends Controller
{
    // DAFTAR PENGADUAN
    public function index(Request $request)
    {
        $query = ModelPengaduan::with([
            'pengadu',
            'pmi',
            'kategori',
            'wilayah',
            'petugas',
        ]);

        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('nomor_tiket', 'like', "%{$cari}%")
                    ->orWhere('judul', 'like', "%{$cari}%")
                    ->orWhere('status', 'like', "%{$cari}%")
                    ->orWhereHas('pengadu', function ($pengadu) use ($cari) {
                        $pengadu->where('nama', 'like', "%{$cari}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $data = $query->latest('idpengaduan')
            ->paginate(10)
            ->withQueryString();

        $totalPengaduan = ModelPengaduan::count();
        $menunggu = ModelPengaduan::where('status', 'menunggu_verifikasi')->count();
        $diproses = ModelPengaduan::where('status', 'diproses')->count();
        $selesai = ModelPengaduan::where('status', 'selesai')->count();
        $ditolak = ModelPengaduan::where('status', 'ditolak')->count();

        return view('admin.pengaduan.index', compact(
            'data',
            'totalPengaduan',
            'menunggu',
            'diproses',
            'selesai',
            'ditolak'
        ));
    }

    // DETAIL PENGADUAN
    public function show($id)
    {
        $pengaduan = ModelPengaduan::with([
            'pengadu',
            'pmi',
            'kategori',
            'wilayah',
            'petugas',
            'bukti',
            'tindaklanjut.petugas',
        ])->findOrFail($id);

        // Ambil akun Petugas yang aktif
        $petugas = ModelUser::where('role', 'petugas')
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();

        return view('admin.pengaduan.show', compact(
            'pengaduan',
            'petugas'
        ));
    }

    // TUGASKAN PENGADUAN KEPADA PETUGAS
    public function tugaskan(Request $request, $id)
    {
        $request->validate([
            'iduser' => ['required', 'integer'],
        ], [
            'iduser.required' => 'Silakan pilih Petugas terlebih dahulu.',
        ]);

        $pengaduan = ModelPengaduan::findOrFail($id);

        // Pastikan akun yang dipilih benar-benar Petugas aktif
        $petugas = ModelUser::where('iduser', $request->iduser)
            ->where('role', 'petugas')
            ->where('aktif', true)
            ->first();

        if (!$petugas) {
            return back()
                ->withErrors(['iduser' => 'Petugas tidak ditemukan atau akunnya tidak aktif.'])
                ->withInput();
        }

        // Hindari membuat notifikasi berulang jika Petugas sama
        if ((int) $pengaduan->iduser === (int) $petugas->iduser) {
            return back()->with('success', 'Pengaduan sudah ditugaskan kepada Petugas tersebut.');
        }

        DB::transaction(function () use ($pengaduan, $petugas) {

            // Simpan penugasan
            $pengaduan->iduser = $petugas->iduser;
            $pengaduan->save();

            // Buat notifikasi untuk Petugas
            ModelNotifikasi::create([
                'idpengadu' => null,
                'iduser' => $petugas->iduser,
                'idpengaduan' => $pengaduan->idpengaduan,
                'judul' => 'Penugasan Pengaduan Baru',
                'pesan' => 'Anda mendapatkan tugas menangani pengaduan '
                    . ($pengaduan->nomor_tiket ?? '')
                    . ' dengan judul: '
                    . $pengaduan->judul,
                'dibaca' => false,
                'dibaca_pada' => null,
            ]);
        });

        return redirect()
            ->route('admin.pengaduan.show', $pengaduan->idpengaduan)
            ->with('success', 'Pengaduan berhasil ditugaskan kepada ' . $petugas->nama . '. Notifikasi telah dikirim.');
    }
}
