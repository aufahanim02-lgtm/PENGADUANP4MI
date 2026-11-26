<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerAuthLogout extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        Auth::guard('pengadu')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Kamu berhasil logout.');
    }
}
