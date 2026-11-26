<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\ModelWilayah;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ControllerWilayah extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX - MENAMPILKAN DATA WILAYAH
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = ModelWilayah::query();

        // Pencarian wilayah
        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('provinsi', 'like', "%{$cari}%")
                    ->orWhere('kabupaten', 'like', "%{$cari}%")
                    ->orWhere('kecamatan', 'like', "%{$cari}%")
                    ->orWhere('desa', 'like', "%{$cari}%");
            });
        }

        // Data wilayah
        $data = $query
            ->latest('idwilayah')
            ->paginate(10)
            ->withQueryString();

        // Statistik wilayah
        $totalWilayah = ModelWilayah::count();

        return view('admin.wilayah.index', compact(
            'data',
            'totalWilayah'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE - FORM TAMBAH WILAYAH
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.wilayah.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE - SIMPAN WILAYAH
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'provinsi' => [
                'required',
                'string',
                'max:100',
            ],

            'kabupaten' => [
                'required',
                'string',
                'max:100',
            ],

            'kecamatan' => [
                'nullable',
                'string',
                'max:100',
            ],

            'desa' => [
                'nullable',
                'string',
                'max:100',
            ],
        ], [
            'provinsi.required' => 'Provinsi wajib diisi.',
            'provinsi.max' => 'Nama provinsi maksimal 100 karakter.',
            'kabupaten.required' => 'Kabupaten wajib diisi.',
            'kabupaten.max' => 'Nama kabupaten maksimal 100 karakter.',
            'kecamatan.max' => 'Nama kecamatan maksimal 100 karakter.',
            'desa.max' => 'Nama desa maksimal 100 karakter.',
        ]);

        ModelWilayah::create($validated);

        return redirect()
            ->route('admin.wilayah.index')
            ->with('success', 'Wilayah berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW - DETAIL WILAYAH
    |--------------------------------------------------------------------------
    */

    public function show(string $id)
    {
        $wilayah = ModelWilayah::with('pengaduan')
            ->findOrFail($id);

        return view('admin.wilayah.show', compact('wilayah'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT - FORM EDIT WILAYAH
    |--------------------------------------------------------------------------
    */

    public function edit(string $id)
    {
        $wilayah = ModelWilayah::findOrFail($id);

        return view('admin.wilayah.edit', compact('wilayah'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE - PERBARUI WILAYAH
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, string $id)
    {
        $wilayah = ModelWilayah::findOrFail($id);

        $validated = $request->validate([
            'provinsi' => [
                'required',
                'string',
                'max:100',
            ],

            'kabupaten' => [
                'required',
                'string',
                'max:100',
            ],

            'kecamatan' => [
                'nullable',
                'string',
                'max:100',
            ],

            'desa' => [
                'nullable',
                'string',
                'max:100',
            ],
        ], [
            'provinsi.required' => 'Provinsi wajib diisi.',
            'provinsi.max' => 'Nama provinsi maksimal 100 karakter.',
            'kabupaten.required' => 'Kabupaten wajib diisi.',
            'kabupaten.max' => 'Nama kabupaten maksimal 100 karakter.',
            'kecamatan.max' => 'Nama kecamatan maksimal 100 karakter.',
            'desa.max' => 'Nama desa maksimal 100 karakter.',
        ]);

        $wilayah->update($validated);

        return redirect()
            ->route('admin.wilayah.index')
            ->with('success', 'Wilayah berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY - HAPUS WILAYAH
    |--------------------------------------------------------------------------
    */

    public function destroy(string $id)
    {
        $wilayah = ModelWilayah::findOrFail($id);

        // Cek apakah wilayah masih digunakan pengaduan
        if ($wilayah->pengaduan()->exists()) {
            return redirect()
                ->route('admin.wilayah.index')
                ->with(
                    'error',
                    'Wilayah tidak dapat dihapus karena masih digunakan oleh data pengaduan.'
                );
        }

        try {
            $wilayah->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('admin.wilayah.index')
                ->with(
                    'error',
                    'Wilayah tidak dapat dihapus karena masih terhubung dengan data lain.'
                );
        }

        return redirect()
            ->route('admin.wilayah.index')
            ->with('success', 'Wilayah berhasil dihapus.');
    }
}
