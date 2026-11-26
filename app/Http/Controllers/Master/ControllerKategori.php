<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\ModelKategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class ControllerKategori extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX - MENAMPILKAN DATA KATEGORI
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = ModelKategori::query();

        // Pencarian kategori
        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('nama', 'like', "%{$cari}%")
                    ->orWhere('deskripsi', 'like', "%{$cari}%");
            });
        }

        // Filter status aktif
        if ($request->filled('aktif')) {
            $query->where('aktif', $request->aktif);
        }

        // Data kategori
        $data = $query
            ->latest('idkategori')
            ->paginate(10)
            ->withQueryString();

        // Statistik kategori
        $totalKategori = ModelKategori::count();

        $kategoriAktif = ModelKategori::where('aktif', true)->count();

        $kategoriNonaktif = ModelKategori::where('aktif', false)->count();

        return view('admin.kategori.index', compact(
            'data',
            'totalKategori',
            'kategoriAktif',
            'kategoriNonaktif'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE - FORM TAMBAH KATEGORI
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.kategori.create');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE - SIMPAN KATEGORI
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:100',
                'unique:kategori,nama',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'aktif' => [
                'required',
                'boolean',
            ],
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.max' => 'Nama kategori maksimal 100 karakter.',
            'nama.unique' => 'Nama kategori sudah tersedia.',
            'aktif.required' => 'Status kategori wajib dipilih.',
        ]);

        ModelKategori::create($validated);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW - DETAIL KATEGORI
    |--------------------------------------------------------------------------
    */

    public function show(string $id)
    {
        $kategori = ModelKategori::with('pengaduan')
            ->findOrFail($id);

        return view('admin.kategori.show', compact('kategori'));
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT - FORM EDIT KATEGORI
    |--------------------------------------------------------------------------
    */

    public function edit(string $id)
    {
        $kategori = ModelKategori::findOrFail($id);

        return view('admin.kategori.edit', compact('kategori'));
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE - PERBARUI KATEGORI
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, string $id)
    {
        $kategori = ModelKategori::findOrFail($id);

        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:100',
                Rule::unique('kategori', 'nama')->ignore(
                    $kategori->idkategori,
                    'idkategori'
                ),
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'aktif' => [
                'required',
                'boolean',
            ],
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.max' => 'Nama kategori maksimal 100 karakter.',
            'nama.unique' => 'Nama kategori sudah digunakan.',
            'aktif.required' => 'Status kategori wajib dipilih.',
        ]);

        $kategori->update($validated);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY - HAPUS KATEGORI
    |--------------------------------------------------------------------------
    */

    public function destroy(string $id)
    {
        $kategori = ModelKategori::findOrFail($id);

        // Cek apakah kategori masih digunakan pengaduan
        if ($kategori->pengaduan()->exists()) {
            return redirect()
                ->route('admin.kategori.index')
                ->with(
                    'error',
                    'Kategori tidak dapat dihapus karena masih digunakan oleh data pengaduan. Silakan nonaktifkan kategori.'
                );
        }

        try {
            $kategori->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('admin.kategori.index')
                ->with(
                    'error',
                    'Kategori tidak dapat dihapus karena masih terhubung dengan data lain.'
                );
        }

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
