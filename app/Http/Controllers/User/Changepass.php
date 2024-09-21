<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Changepass extends Controller
{
    public function Index(Request $request)
    {
        return view('user/changepass', [
            'title' => 'Ganti Password',
        ]);
    }
}
