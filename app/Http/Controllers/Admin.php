<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin extends Controller
{
    public function index(Request $request)
    {
        return view('admin/dashboard', [
            'title' => 'Dashboard'
        ]);
    }

    public function profile(Request $request)
    {
        return view('admin/profile', [
            'title' => 'Profile'
        ]);
    }

    public function login(Request $request)
    {
        return view('admin/login', [
            'title' => 'Admin | Login'
        ]);
    }

    public function doLogin(Request $request)
    {
        dd($request);
    }
}
