<?php

namespace App\Http\Controllers\DataUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Pkl extends Controller
{
    public function index(Request $request)
    {
        return view('admin/datauser/pkl', [
            'title' => 'Data PKL'
        ]);
    }
}
