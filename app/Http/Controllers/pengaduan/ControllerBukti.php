<?php

namespace App\Http\Controllers\Pengaduan;

use App\Http\Controllers\Controller;
use App\Models\ModelPengaduan;
use App\Models\ModelBukti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class ControllerBukti extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PENGADUAN MILIK PETUGAS YANG LOGIN
    |--------------------------------------------------------------------------
    */

    private function getPengaduan($idpengaduan)
    {
        return ModelPengaduan::where('iduser', auth('user')->id())
            ->findOrFail($idpengaduan);
    }


    /*
    |--------------------------------------------------------------------------
    | INDEX - DAFTAR BUKTI
    |--------------------------------------------------------------------------
    */

    public function index($idpengaduan)
    {
        $pengaduan = $this->getPengaduan($idpengaduan);

        $bukti = $pengaduan->bukti()
            ->latest('idbukti')
            ->paginate(10);

        return view('petugas.bukti.index', compact(
            'pengaduan',
            'bukti'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | STORE - UPLOAD BUKTI
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, $idpengaduan)
    {
        $pengaduan = $this->getPengaduan($idpengaduan);

        $validated = $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf,doc,docx',
                'max:5120',
            ],
            'keterangan' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'file.required' => 'File bukti wajib dipilih.',
            'file.file' => 'File yang diunggah tidak valid.',
            'file.mimes' => 'Format file harus JPG, JPEG, PNG, PDF, DOC, atau DOCX.',
            'file.max' => 'Ukuran file maksimal 5 MB.',
            'keterangan.max' => 'Keterangan maksimal 1000 karakter.',
        ]);

        $file = $request->file('file');

        $namaAsli = $file->getClientOriginalName();

        $path = $file->store(
            'bukti-pengaduan/' . $idpengaduan,
            'public'
        );

        try {
            $bukti = new ModelBukti();

            $bukti->idpengaduan = $pengaduan->idpengaduan;
            $bukti->namafile = $namaAsli;
            $bukti->pathfile = $path;
            $bukti->jenisfile = $file->getClientMimeType();
            $bukti->ukuranfile = $file->getSize();
            $bukti->keterangan = $validated['keterangan'] ?? null;

            $bukti->save();

            return redirect()
                ->route('petugas.pengaduan.bukti.index', $idpengaduan)
                ->with('success', 'Bukti pengaduan berhasil diunggah.');
        } catch (QueryException $e) {

            Storage::disk('public')->delete($path);

            report($e);

            return back()
                ->withInput()
                ->with('error', 'Bukti pengaduan gagal disimpan.');
        }
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW - DETAIL BUKTI
    |--------------------------------------------------------------------------
    */

    public function show($idpengaduan, $idbukti)
    {
        $pengaduan = $this->getPengaduan($idpengaduan);

        $bukti = $pengaduan->bukti()
            ->findOrFail($idbukti);

        return view('petugas.bukti.show', compact(
            'pengaduan',
            'bukti'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE - PERBARUI KETERANGAN
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $idpengaduan, $idbukti)
    {
        $pengaduan = $this->getPengaduan($idpengaduan);

        $bukti = $pengaduan->bukti()
            ->findOrFail($idbukti);

        $validated = $request->validate([
            'keterangan' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'keterangan.max' => 'Keterangan maksimal 1000 karakter.',
        ]);

        $bukti->keterangan = $validated['keterangan'] ?? null;
        $bukti->save();

        return redirect()
            ->route('petugas.pengaduan.bukti.index', $idpengaduan)
            ->with('success', 'Keterangan bukti berhasil diperbarui.');
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY - HAPUS BUKTI
    |--------------------------------------------------------------------------
    */

    public function destroy($idpengaduan, $idbukti)
    {
        $pengaduan = $this->getPengaduan($idpengaduan);

        $bukti = $pengaduan->bukti()
            ->findOrFail($idbukti);

        try {

            Storage::disk('public')->delete($bukti->pathfile);

            $bukti->delete();

            return redirect()
                ->route('petugas.pengaduan.bukti.index', $idpengaduan)
                ->with('success', 'Bukti pengaduan berhasil dihapus.');
        } catch (QueryException $e) {

            report($e);

            return redirect()
                ->route('petugas.pengaduan.bukti.index', $idpengaduan)
                ->with('error', 'Bukti pengaduan gagal dihapus.');
        }
    }
}
