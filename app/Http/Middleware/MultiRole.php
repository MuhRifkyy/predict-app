<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MultiRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (! $request->expectsJson()) {
            $userRoles = auth()->user()->role; // Ubah ini dengan cara yang benar sesuai dengan model User dan kolom role yang kamu miliki

            foreach ($roles as $role) {
                if ($userRoles == $role) {
                    return $next($request);
                }
            }
        }

        // Jika pengguna tidak memiliki salah satu dari peran yang diizinkan, redirect atau berikan respons sesuai kebijakan aplikasimu.
        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
