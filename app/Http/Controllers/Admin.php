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
}
