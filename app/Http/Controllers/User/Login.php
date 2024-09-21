<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Login extends Controller
{
    public function index(Request $request)
    {
        return view('user/loginuser', [
            'title' => 'Login',
        ]);
    }
}
