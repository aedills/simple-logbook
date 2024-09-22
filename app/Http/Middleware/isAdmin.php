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
        if (!$request->session()->has('id')) {
            return redirect()->route('auth.login')->with('error', 'Anda harus login terlebih dahulu!');
        } else {
            if ($request->session()->has('role') == 'admin' || $request->session()->has('role') == 'staf') {
                return $next($request);
            } else {
                return redirect()->route('auth.login')->with('error', 'Anda harus login sebagai Admin!');
            }
        }

        return $next($request);
    }
}
