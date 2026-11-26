<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {
        $user = Auth::guard('user')->user();

        if ($user) {
            if (!in_array($user->role, $roles, true)) {
                abort(403, 'Kamu tidak memiliki hak akses ke halaman ini.');
            }

            return $next($request);
        }

        $pengadu = Auth::guard('pengadu')->user();

        if ($pengadu && in_array('pengadu', $roles, true)) {
            return $next($request);
        }

        return redirect()
            ->route('login')
            ->with('error', 'Silakan login terlebih dahulu.');
    }
}
