<?php

namespace App\Http\Controllers\Tindaklanjut;

use App\Http\Controllers\Controller;
use App\Models\ModelPengaduan;
use App\Models\ModelTindaklanjut;
use App\Models\ModelNotifikasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ControllerTindaklanjut extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | MEMBUAT NOTIFIKASI UNTUK PENGADU
    |--------------------------------------------------------------------------
    */

    private function buatNotifikasi(
        ModelPengaduan $pengaduan,
        string $judul,
        string $pesan
    ): void {
        ModelNotifikasi::create([
            'idpengadu' => $pengaduan->idpengadu,
            'iduser' => null,
            'idpengaduan' => $pengaduan->idpengaduan,
            'judul' => $judul,
            'pesan' => $pesan,
            'dibaca' => false,
            'dibaca_pada' => null,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | LABEL STATUS
    |--------------------------------------------------------------------------
    */

    private function labelStatus(string $status): string
    {
        return match ($status) {
            'menunggu_verifikasi' => 'Menunggu Verifikasi',
            'diproses' => 'Sedang Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
            default => ucfirst(str_replace('_', ' ', $status)),
        };
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX - DAFTAR TINDAK LANJUT
    |--------------------------------------------------------------------------
    */

    public function index($idpengaduan)
    {
        $pengaduan = ModelPengaduan::where(
            'iduser',
            auth('user')->id()
        )->with(['pengadu', 'kategori'])->findOrFail($idpengaduan);

        $data = ModelTindaklanjut::with('petugas')
            ->where('idpengaduan', $idpengaduan)
            ->latest('idtindaklanjut')
            ->paginate(10);

        return view(
            'petugas.Pengaduan.tindaklanjut.index',
            compact('pengaduan', 'data')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE - FORM TAMBAH TINDAK LANJUT
    |--------------------------------------------------------------------------
    */

    public function create($idpengaduan)
    {
        $pengaduan = ModelPengaduan::where(
            'iduser',
            auth('user')->id()
        )->findOrFail($idpengaduan);

        return view(
            'petugas.Pengaduan.tindaklanjut.create',
            compact('pengaduan')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE - SIMPAN TINDAK LANJUT DAN KIRIM NOTIFIKASI
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, $idpengaduan)
    {
        $pengaduan = ModelPengaduan::where(
            'iduser',
            auth('user')->id()
        )->findOrFail($idpengaduan);

        $validated = $request->validate([
            'keterangan' => [
                'required',
                'string',
            ],

            'status' => [
                'required',
                Rule::in([
                    'diproses',
                    'selesai',
                    'ditolak',
                ]),
            ],
        ], [
            'keterangan.required' => 'Keterangan tindak lanjut wajib diisi.',
            'status.required' => 'Status pengaduan wajib dipilih.',
            'status.in' => 'Status pengaduan tidak valid.',
        ]);

        try {
            DB::transaction(function () use (
                $pengaduan,
                $validated
            ) {
                ModelTindaklanjut::create([
                    'idpengaduan' => $pengaduan->idpengaduan,
                    'iduser' => auth('user')->id(),
                    'keterangan' => $validated['keterangan'],
                    'status' => $validated['status'],
                    'tanggal' => now(),
                ]);

                // Perbarui status pengaduan
                $pengaduan->update([
                    'status' => $validated['status'],
                ]);

                // Buat notifikasi untuk Pengadu
                $this->buatNotifikasi(
                    $pengaduan,
                    'Pembaruan Pengaduan',
                    'Petugas telah memberikan tindak lanjut untuk pengaduan Anda. Status pengaduan sekarang: '
                        . $this->labelStatus($validated['status'])
                        . '. Keterangan: '
                        . $validated['keterangan']
                );
            });

            return redirect()
                ->route(
                    'petugas.pengaduan.tindaklanjut.index',
                    $idpengaduan
                )
                ->with(
                    'success',
                    'Tindak lanjut berhasil ditambahkan dan notifikasi berhasil dikirim kepada Pengadu.'
                );
        } catch (QueryException $e) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Tindak lanjut gagal disimpan. Periksa kembali data dan struktur database.'
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW - DETAIL TINDAK LANJUT
    |--------------------------------------------------------------------------
    */

    public function show($idpengaduan, $idtindaklanjut)
    {
        $pengaduan = ModelPengaduan::where(
            'iduser',
            auth('user')->id()
        )->findOrFail($idpengaduan);

        $tindaklanjut = ModelTindaklanjut::with('petugas')
            ->where('idpengaduan', $idpengaduan)
            ->findOrFail($idtindaklanjut);

        return view(
            'petugas.Pengaduan.tindaklanjut.show',
            compact('pengaduan', 'tindaklanjut')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT - FORM EDIT TINDAK LANJUT
    |--------------------------------------------------------------------------
    */

    public function edit($idpengaduan, $idtindaklanjut)
    {
        $pengaduan = ModelPengaduan::where(
            'iduser',
            auth('user')->id()
        )->findOrFail($idpengaduan);

        $tindaklanjut = ModelTindaklanjut::where(
            'idpengaduan',
            $idpengaduan
        )->findOrFail($idtindaklanjut);

        return view(
            'petugas.Pengaduan.tindaklanjut.edit',
            compact('pengaduan', 'tindaklanjut')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE - PERBARUI TINDAK LANJUT DAN KIRIM NOTIFIKASI
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        $idpengaduan,
        $idtindaklanjut
    ) {
        $pengaduan = ModelPengaduan::where(
            'iduser',
            auth('user')->id()
        )->findOrFail($idpengaduan);

        $tindaklanjut = ModelTindaklanjut::where(
            'idpengaduan',
            $idpengaduan
        )->findOrFail($idtindaklanjut);

        $validated = $request->validate([
            'keterangan' => [
                'required',
                'string',
            ],

            'status' => [
                'required',
                Rule::in([
                    'diproses',
                    'selesai',
                    'ditolak',
                ]),
            ],
        ], [
            'keterangan.required' => 'Keterangan tindak lanjut wajib diisi.',
            'status.required' => 'Status pengaduan wajib dipilih.',
            'status.in' => 'Status pengaduan tidak valid.',
        ]);

        try {
            DB::transaction(function () use (
                $pengaduan,
                $tindaklanjut,
                $validated
            ) {
                $tindaklanjut->update([
                    'keterangan' => $validated['keterangan'],
                    'status' => $validated['status'],
                ]);

                // Sinkronkan status pengaduan
                $pengaduan->update([
                    'status' => $validated['status'],
                ]);

                // Buat notifikasi untuk Pengadu
                $this->buatNotifikasi(
                    $pengaduan,
                    'Tindak Lanjut Diperbarui',
                    'Petugas telah memperbarui tindak lanjut pengaduan Anda. Status terbaru: '
                        . $this->labelStatus($validated['status'])
                        . '. Keterangan: '
                        . $validated['keterangan']
                );
            });

            return redirect()
                ->route(
                    'petugas.pengaduan.tindaklanjut.index',
                    $idpengaduan
                )
                ->with(
                    'success',
                    'Tindak lanjut berhasil diperbarui dan notifikasi berhasil dikirim kepada Pengadu.'
                );
        } catch (QueryException $e) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Tindak lanjut gagal diperbarui.'
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY - HAPUS TINDAK LANJUT
    |--------------------------------------------------------------------------
    */

    public function destroy($idpengaduan, $idtindaklanjut)
    {
        $pengaduan = ModelPengaduan::where(
            'iduser',
            auth('user')->id()
        )->findOrFail($idpengaduan);

        $tindaklanjut = ModelTindaklanjut::where(
            'idpengaduan',
            $idpengaduan
        )->findOrFail($idtindaklanjut);

        try {
            DB::transaction(function () use (
                $pengaduan,
                $tindaklanjut,
                $idpengaduan
            ) {
                $tindaklanjut->delete();

                // Ambil riwayat terbaru yang masih tersisa
                $riwayatTerbaru = ModelTindaklanjut::where(
                    'idpengaduan',
                    $idpengaduan
                )->latest('idtindaklanjut')->first();

                if ($riwayatTerbaru) {
                    $pengaduan->update([
                        'status' => $riwayatTerbaru->status,
                    ]);
                } else {
                    $pengaduan->update([
                        'status' => 'menunggu_verifikasi',
                    ]);
                }
            });

            return redirect()
                ->route(
                    'petugas.pengaduan.tindaklanjut.index',
                    $idpengaduan
                )
                ->with(
                    'success',
                    'Tindak lanjut berhasil dihapus.'
                );
        } catch (QueryException $e) {
            return back()
                ->with(
                    'error',
                    'Tindak lanjut gagal dihapus.'
                );
        }
    }
}
