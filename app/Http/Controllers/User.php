<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{
    public function login(Request $request)
    {
        return view('user/loginuser', [
            'title' => 'Login',
        ]);
    }
}
