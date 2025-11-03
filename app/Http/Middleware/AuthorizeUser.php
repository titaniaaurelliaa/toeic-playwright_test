<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorizeUser
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Debugging: Cek role user
        // \Log::info('User Role: ', ['role' => $user->roles->role_kode ?? null]);

        if (!$user->roles) {
            abort(403, 'User tidak memiliki role');
        }

        if (in_array($user->roles->role_kode, $roles)) {
            return $next($request);
        }

        abort(403, 'Akses ditolak untuk role ini');
    }
}
