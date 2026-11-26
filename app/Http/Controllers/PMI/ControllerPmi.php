<?php

namespace App\Http\Controllers\PMI;

use App\Http\Controllers\Controller;
use App\Models\ModelPmi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ControllerPmi extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX - MENAMPILKAN DATA PMI MILIK PENGADU
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $idpengadu = auth('pengadu')->id();

        $query = ModelPmi::where('idpengadu', $idpengadu);

        // Pencarian data PMI
        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('nama', 'like', "%{$cari}%")
                    ->orWhere('nik', 'like', "%{$cari}%")
                    ->orWhere('negara', 'like', "%{$cari}%")
                    ->orWhere('perusahaan', 'like', "%{$cari}%");
            });
        }

        $data = $query
            ->latest('idpmi')
            ->paginate(10)
            ->withQueryString();

        $totalPmi = ModelPmi::where('idpengadu', $idpengadu)->count();

        return view('pengadu.pmi.index', compact(
            'data',
            'totalPmi'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE - FORM TAMBAH DATA PMI
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('pengadu.pmi.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE - SIMPAN DATA PMI
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:100',
            ],

            'nik' => [
                'nullable',
                'digits:16',
            ],

            'jeniskelamin' => [
                'nullable',
                Rule::in(['Laki-laki', 'Perempuan']),
            ],

            'tanggallahir' => [
                'nullable',
                'date',
                'before:today',
            ],

            'nohp' => [
                'nullable',
                'string',
                'max:20',
            ],

            'negara' => [
                'nullable',
                'string',
                'max:100',
            ],

            'perusahaan' => [
                'nullable',
                'string',
                'max:150',
            ],

            'alamatkerja' => [
                'nullable',
                'string',
            ],

            'statuspmi' => [
                'nullable',
                'string',
                'max:50',
            ],
        ], [
            'nama.required' => 'Nama PMI wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'jeniskelamin.in' => 'Jenis kelamin tidak valid.',
            'tanggallahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'nohp.max' => 'Nomor HP maksimal 20 karakter.',
            'negara.max' => 'Nama negara maksimal 100 karakter.',
            'perusahaan.max' => 'Nama perusahaan maksimal 150 karakter.',
            'statuspmi.max' => 'Status PMI maksimal 50 karakter.',
        ]);

        // Pemilik data otomatis mengikuti akun Pengadu yang login
        $validated['idpengadu'] = auth('pengadu')->id();

        ModelPmi::create($validated);

        return redirect()
            ->route('pengadu.pmi.index')
            ->with('success', 'Data PMI berhasil ditambahkan.');
    }



    /*
    |--------------------------------------------------------------------------
    | EDIT - FORM EDIT DATA PMI
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $pmi = ModelPmi::where('idpengadu', auth('pengadu')->id())
            ->findOrFail($id);

        return view('pengadu.pmi.edit', compact('pmi'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE - PERBARUI DATA PMI
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $pmi = ModelPmi::where('idpengadu', auth('pengadu')->id())
            ->findOrFail($id);

        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:100',
            ],

            'nik' => [
                'nullable',
                'digits:16',
            ],

            'jeniskelamin' => [
                'nullable',
                Rule::in(['Laki-laki', 'Perempuan']),
            ],

            'tanggallahir' => [
                'nullable',
                'date',
                'before:today',
            ],

            'nohp' => [
                'nullable',
                'string',
                'max:20',
            ],

            'negara' => [
                'nullable',
                'string',
                'max:100',
            ],

            'perusahaan' => [
                'nullable',
                'string',
                'max:150',
            ],

            'alamatkerja' => [
                'nullable',
                'string',
            ],

            'statuspmi' => [
                'nullable',
                'string',
                'max:50',
            ],
        ], [
            'nama.required' => 'Nama PMI wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'jeniskelamin.in' => 'Jenis kelamin tidak valid.',
            'tanggallahir.before' => 'Tanggal lahir harus sebelum hari ini.',
        ]);

        $pmi->update($validated);

        return redirect()
            ->route('pengadu.pmi.index')
            ->with('success', 'Data PMI berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY - HAPUS DATA PMI
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $pmi = ModelPmi::where('idpengadu', auth('pengadu')->id())
            ->findOrFail($id);

        // Periksa apakah data PMI masih digunakan dalam pengaduan
        if ($pmi->pengaduan()->exists()) {
            return redirect()
                ->route('pengadu.pmi.index')
                ->with(
                    'error',
                    'Data PMI tidak dapat dihapus karena masih terhubung dengan pengaduan.'
                );
        }

        $pmi->delete();

        return redirect()
            ->route('pengadu.pmi.index')
            ->with('success', 'Data PMI berhasil dihapus.');
    }
}
