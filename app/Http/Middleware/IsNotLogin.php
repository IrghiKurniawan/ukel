<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsNotLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user(); // Ambil user jika sudah login

            if ($user->role === 'GUEST') {
                return redirect()->route('report.index')
                    ->with('failed', 'Anda sudah login, anda tidak bisa masuk ke halaman login lagi!');
            }

            if ($user->role === 'STAFF') {
                return redirect()->route('response')
                    ->with('failed', 'Anda sudah login, anda tidak bisa masuk ke halaman login lagi!');
            }

            if ($user->role === 'HEAD_STAFF') {
                return redirect()->route('home.akun')
                    ->with('failed', 'Anda sudah login, anda tidak bisa masuk ke halaman login lagi!');
            }
        }

        // Jika tidak ada kondisi di atas, lanjutkan request
        return $next($request);
    }
}
