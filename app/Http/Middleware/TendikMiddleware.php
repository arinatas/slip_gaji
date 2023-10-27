<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;

class TendikMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // Memeriksa apakah pengguna saat ini adalah tendik
        if (Auth::check() && Auth::user()->jenis_pegawai == 1) {
            return $next($request);
        }

        return redirect('/userDashboard')->with('insertFail', 'Anda Bukan Tendik!');
    }

}
