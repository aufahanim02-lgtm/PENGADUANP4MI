<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ControllerUser extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX - DAFTAR USER
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = ModelUser::query();

        // PENCARIAN
        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('nama', 'like', "%{$cari}%")
                    ->orWhere('username', 'like', "%{$cari}%");
            });
        }

        // FILTER ROLE
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // FILTER STATUS
        if ($request->filled('aktif')) {
            $query->where('aktif', $request->aktif);
        }

        $data = $query
            ->latest('iduser')
            ->paginate(10)
            ->withQueryString();

        $totalUser = ModelUser::count();

        $totalAdmin = ModelUser::where('role', 'admin')->count();

        $totalPetugas = ModelUser::where('role', 'petugas')->count();

        $totalAktif = ModelUser::where('aktif', true)->count();

        $totalNonaktif = ModelUser::where('aktif', false)->count();

        return view('admin.user.index', compact(
            'data',
            'totalUser',
            'totalAdmin',
            'totalPetugas',
            'totalAktif',
            'totalNonaktif'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE - FORM TAMBAH USER
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.user.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE - SIMPAN USER
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

            'username' => [
                'required',
                'string',
                'max:50',
                'alpha_dash',
                'unique:user,username',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'role' => [
                'required',
                Rule::in(['admin', 'petugas']),
            ],

            'aktif' => [
                'required',
                'boolean',
            ],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 100 karakter.',
            'username.required' => 'Username wajib diisi.',
            'username.max' => 'Username maksimal 50 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, tanda strip, dan garis bawah.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Role wajib dipilih.',
            'aktif.required' => 'Status akun wajib dipilih.',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        ModelUser::create($validated);

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW - DETAIL USER
    |--------------------------------------------------------------------------
    */

    public function show(string $id)
    {
        $user = ModelUser::findOrFail($id);

        return view('admin.user.show', compact('user'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT - FORM EDIT USER
    |--------------------------------------------------------------------------
    */

    public function edit(string $id)
    {
        $user = ModelUser::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE - PERBARUI USER
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, string $id)
    {
        $user = ModelUser::findOrFail($id);

        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:100',
            ],

            'username' => [
                'required',
                'string',
                'max:50',
                'alpha_dash',
                Rule::unique('user', 'username')->ignore(
                    $user->iduser,
                    'iduser'
                ),
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],

            'role' => [
                'required',
                Rule::in(['admin', 'petugas']),
            ],

            'aktif' => [
                'required',
                'boolean',
            ],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 100 karakter.',
            'username.required' => 'Username wajib diisi.',
            'username.max' => 'Username maksimal 50 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'username.alpha_dash' => 'Format username tidak valid.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Role wajib dipilih.',
            'aktif.required' => 'Status akun wajib dipilih.',
        ]);

        // CEGAH MENONAKTIFKAN AKUN SENDIRI
        if (
            auth('user')->id() == $user->iduser &&
            !$request->boolean('aktif')
        ) {
            return back()
                ->withInput()
                ->with('error', 'Akun yang sedang digunakan tidak dapat dinonaktifkan.');
        }

        // PASSWORD HANYA DIUBAH JIKA DIISI
        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make(
                $validated['password']
            );
        }

        $user->update($validated);

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY - NONAKTIFKAN USER
    |--------------------------------------------------------------------------
    */

    public function destroy(string $id)
    {
        $user = ModelUser::findOrFail($id);

        // CEGAH MENONAKTIFKAN AKUN SENDIRI
        if (auth('user')->id() == $user->iduser) {
            return redirect()
                ->route('admin.user.index')
                ->with('error', 'Akun yang sedang digunakan tidak dapat dinonaktifkan.');
        }

        // NONAKTIFKAN AKUN, BUKAN HAPUS PERMANEN
        $user->update([
            'aktif' => false,
        ]);

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Akun user berhasil dinonaktifkan.');
    }
}
