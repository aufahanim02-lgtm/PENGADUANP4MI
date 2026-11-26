<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ControllerAuthUser extends Controller
{
    public function edit()
    {
        $pengadu = auth('pengadu')->user();

        return view('pengadu.profil.edit', compact('pengadu'));
    }

    public function update(Request $request)
    {
        $pengadu = auth('pengadu')->user();

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

            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'nik.unique' => 'NIK sudah digunakan.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $pengadu->nama = $validated['nama'];
        $pengadu->nik = $validated['nik'] ?? null;
        $pengadu->nohp = $validated['nohp'] ?? null;
        $pengadu->alamat = $validated['alamat'] ?? null;
        $pengadu->username = $validated['username'];

        if (!empty($validated['password'])) {
            $pengadu->password = Hash::make($validated['password']);
        }

        $pengadu->save();

        return redirect()
            ->route('pengadu.profil.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
