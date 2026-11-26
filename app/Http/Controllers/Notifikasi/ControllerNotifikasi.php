<?php

namespace App\Http\Controllers\Notifikasi;

use App\Http\Controllers\Controller;
use App\Models\ModelNotifikasi;

class ControllerNotifikasi extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | QUERY NOTIFIKASI KHUSUS PENGADU
    |--------------------------------------------------------------------------
    */

    private function queryNotifikasi()
    {
        if (!auth('pengadu')->check()) {
            abort(403, 'Anda tidak memiliki akses ke notifikasi.');
        }

        return ModelNotifikasi::with([
            'pengadu',
            'pengaduan',
        ])->where('idpengadu', auth('pengadu')->id());
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX - DAFTAR NOTIFIKASI
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $query = $this->queryNotifikasi();

        $data = (clone $query)
            ->latest('idnotifikasi')
            ->paginate(10);

        $totalNotifikasi = (clone $query)->count();

        $belumDibaca = (clone $query)
            ->where('dibaca', false)
            ->count();

        $sudahDibaca = (clone $query)
            ->where('dibaca', true)
            ->count();

        return view('pengadu.notifikasi.index', compact(
            'data',
            'totalNotifikasi',
            'belumDibaca',
            'sudahDibaca'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW - DETAIL NOTIFIKASI
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $notifikasi = $this->queryNotifikasi()
            ->where('idnotifikasi', $id)
            ->firstOrFail();

        if (!$notifikasi->dibaca) {
            $notifikasi->update([
                'dibaca' => true,
            ]);
        }

        return view('pengadu.notifikasi.show', compact('notifikasi'));
    }

    /*
    |--------------------------------------------------------------------------
    | READ - TANDAI SUDAH DIBACA
    |--------------------------------------------------------------------------
    */

    public function read($id)
    {
        $notifikasi = $this->queryNotifikasi()
            ->where('idnotifikasi', $id)
            ->firstOrFail();

        $notifikasi->update([
            'dibaca' => true,
        ]);

        return back()->with(
            'success',
            'Notifikasi berhasil ditandai sudah dibaca.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | READ ALL - TANDAI SEMUA SUDAH DIBACA
    |--------------------------------------------------------------------------
    */

    public function readAll()
    {
        $this->queryNotifikasi()
            ->where('dibaca', false)
            ->update([
                'dibaca' => true,
            ]);

        return back()->with(
            'success',
            'Semua notifikasi berhasil ditandai sudah dibaca.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY - HAPUS NOTIFIKASI
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $notifikasi = $this->queryNotifikasi()
            ->where('idnotifikasi', $id)
            ->firstOrFail();

        $notifikasi->delete();

        return redirect()
            ->route('pengadu.notifikasi.index')
            ->with('success', 'Notifikasi berhasil dihapus.');
    }
}
