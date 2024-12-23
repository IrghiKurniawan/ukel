<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna sudah autentikasi
        if (Auth::check() && Auth::user()->role !== 'GUEST') {
            return redirect()->route('report.index')->with('failed', 'Anda tidak memiliki akses sebagai admin');
        }

        return $next($request);
    }
}
