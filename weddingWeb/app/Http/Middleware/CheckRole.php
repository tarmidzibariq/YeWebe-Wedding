<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
         // Cek apakah pengguna sudah login dan apakah role-nya sesuai dengan yang diminta
        if (!Auth::check() || Auth::user()->role !== $role) {
            // Jika tidak sesuai, redirect ke halaman utama atau halaman lainnya
            return redirect('/');
        }

        return $next($request);
    }
}
