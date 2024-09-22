<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('uuid')) {
            return redirect()->route('auth.login')->with('error', 'Anda harus login terlebih dahulu!');
        } else {
            if ($request->session()->has('role') == 'magang' || $request->session()->has('role') == 'pkl') {
                return $next($request);
            } elseif ($request->session()->has('role') == 'admin' || $request->session()->has('role') == 'staf') {
                return redirect()->route('admin.dashboard')->with('error', 'Anda telah login sebagai admin!');
            } else {
                return redirect()->route('auth.login')->with('error', 'Anda harus login terlebih dahulu!');
            }
        }

        return $next($request);
    }
}
