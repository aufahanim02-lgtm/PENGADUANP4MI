<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerAuthLogin extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('user')->check()) {
            return $this->redirectDashboard(
                Auth::guard('user')->user()->role
            );
        }

        if (Auth::guard('pengadu')->check()) {
            return redirect()->route('pengadu.dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string'],
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
            'aktif' => 1,
        ];

        // Login Admin dan Petugas
        if (Auth::guard('user')->attempt($credentials)) {
            $user = Auth::guard('user')->user();

            if (in_array($user->role, ['admin', 'petugas'], true)) {
                $request->session()->regenerate();

                return $this->redirectDashboard($user->role)
                    ->with('success', 'Selamat datang, ' . $user->nama . '!');
            }

            Auth::guard('user')->logout();

            return back()
                ->withInput($request->only('username'))
                ->with('error', 'Role akun tidak dikenali.');
        }

        // Login Pengadu
        if (Auth::guard('pengadu')->attempt($credentials)) {
            $pengadu = Auth::guard('pengadu')->user();

            $request->session()->regenerate();

            return redirect()->route('pengadu.dashboard')
                ->with('success', 'Selamat datang, ' . $pengadu->nama . '!');
        }

        return back()
            ->withInput($request->only('username'))
            ->with('error', 'Username atau password salah, atau akun tidak aktif.');
    }

    private function redirectDashboard(string $role)
    {
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($role === 'petugas') {
            return redirect()->route('petugas.dashboard');
        }

        return redirect()->route('login')
            ->with('error', 'Role akun tidak dikenali.');
    }
}
