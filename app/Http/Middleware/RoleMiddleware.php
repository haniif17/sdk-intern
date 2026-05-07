<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah user udah login dan role-nya SESUAI sama yang diizinkan
        if (Auth::check() && Auth::user()->role === $role) {
            // Kalau sesuai, silakan lewat
            return $next($request);
        }

        // Kalau role-nya gak sesuai (misal komunitas iseng buka link admin), tolak!
        abort(403, 'Akses Ditolak! Anda tidak memiliki izin untuk membuka halaman ini.');
    }
}