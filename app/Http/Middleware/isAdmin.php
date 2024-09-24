<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('uuid')) {
            if ($request->session()->get('role') == 'admin' || $request->session()->get('role') == 'staf') {
                return $next($request);
            }elseif (session('role') == 'magang' || session('role') == 'pkl'){
                return back()->with('error', 'Anda tidak memiliki akses ke halaman tersebut.')->withInput();
            }
             else {
                return redirect()->route('auth.login')->with('error', 'Anda harus login sebagai Admin!');
            }
        } else {
            return redirect()->route('auth.login')->with('error', 'Anda harus login terlebih dahulu!');
        }
    }
}
