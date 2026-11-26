<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\ModelPengadu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ControllerPengadu extends Controller
{
    // =========================================
    // MENAMPILKAN DATA PENGADU
    // =========================================
    public function index(Request $request)
    {
        $query = ModelPengadu::query();

        // Pencarian data
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('nohp', 'like', "%{$search}%");
            });
        }

        // Filter status akun
        if ($request->filled('aktif')) {
            $query->where('aktif', $request->aktif);
        }

        $data = $query
            ->withCount(['pmi', 'pengaduan'])
            ->latest('idpengadu')
            ->paginate(10)
            ->withQueryString();

        $totalPengadu = ModelPengadu::count();

        $pengaduAktif = ModelPengadu::where('aktif', true)->count();

        $pengaduNonaktif = ModelPengadu::where('aktif', false)->count();

        return view('admin.pengadu.index', compact(
            'data',
            'totalPengadu',
            'pengaduAktif',
            'pengaduNonaktif'
        ));
    }

    // =========================================
    // FORM TAMBAH PENGADU
    // =========================================
    public function create()
    {
        return view('admin.pengadu.create');
    }

    // =========================================
    // SIMPAN DATA PENGADU
    // =========================================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],

            'nik' => [
                'nullable',
                'digits:16',
                'unique:pengadu,nik',
            ],

            'nohp' => ['nullable', 'string', 'max:20'],

            'alamat' => ['nullable', 'string'],

            'username' => [
                'required',
                'string',
                'max:50',
                'alpha_dash',
                'unique:pengadu,username',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'aktif' => ['required', 'boolean'],
        ], [
            'nama.required' => 'Nama Pengadu wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'username.required' => 'Username wajib diisi.',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
            'username.unique' => 'Username sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'aktif.required' => 'Status akun wajib dipilih.',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        ModelPengadu::create($validated);

        return redirect()
            ->route('admin.pengadu.index')
            ->with('success', 'Data Pengadu berhasil ditambahkan.');
    }

    // =========================================
    // DETAIL PENGADU
    // =========================================
    public function show($id)
    {
        $pengadu = ModelPengadu::with([
            'pmi',
            'pengaduan.kategori',
            'pengaduan.wilayah',
        ])->findOrFail($id);

        return view('admin.pengadu.show', compact('pengadu'));
    }

    // =========================================
    // FORM EDIT PENGADU
    // =========================================
    public function edit($id)
    {
        $pengadu = ModelPengadu::findOrFail($id);

        return view('admin.pengadu.edit', compact('pengadu'));
    }

    // =========================================
    // UPDATE DATA PENGADU
    // =========================================
    public function update(Request $request, $id)
    {
        $pengadu = ModelPengadu::findOrFail($id);

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],

            'nik' => [
                'nullable',
                'digits:16',
                Rule::unique('pengadu', 'nik')
                    ->ignore($pengadu->idpengadu, 'idpengadu'),
            ],

            'nohp' => ['nullable', 'string', 'max:20'],

            'alamat' => ['nullable', 'string'],

            'username' => [
                'required',
                'string',
                'max:50',
                'alpha_dash',
                Rule::unique('pengadu', 'username')
                    ->ignore($pengadu->idpengadu, 'idpengadu'),
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],

            'aktif' => ['required', 'boolean'],
        ], [
            'nama.required' => 'Nama Pengadu wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'nik.unique' => 'NIK sudah digunakan.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'aktif.required' => 'Status akun wajib dipilih.',
        ]);

        // Password hanya diubah jika diisi
        if (!empty($validated['password'])) {
            $pengadu->password = Hash::make($validated['password']);
        }

        unset($validated['password']);

        $pengadu->update($validated);

        return redirect()
            ->route('admin.pengadu.index')
            ->with('success', 'Data Pengadu berhasil diperbarui.');
    }

    // =========================================
    // NONAKTIFKAN AKUN PENGADU
    // =========================================
    public function destroy($id)
    {
        $pengadu = ModelPengadu::findOrFail($id);

        // Tidak menghapus permanen karena data Pengadu
        // terhubung dengan PMI, pengaduan, dan notifikasi.
        $pengadu->aktif = false;
        $pengadu->save();

        return redirect()
            ->route('admin.pengadu.index')
            ->with('success', 'Akun Pengadu berhasil dinonaktifkan.');
    }
}
