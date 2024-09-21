<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{
    public function index(Request $request)
    {
        return view('user/dashboarduser', [
            'title' => 'Dashboard',
        ]);
    }

    public function login(Request $request)
    {
        return view('user/loginuser', [
            'title' => 'Login',
        ]);
    }

    public function changepass(Request $request)
    {
        return view('user/changepass', [
            'title' => 'Ganti Password',
        ]);
    }
}
