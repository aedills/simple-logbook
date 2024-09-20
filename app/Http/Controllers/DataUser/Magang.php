<?php

namespace App\Http\Controllers\DataUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Magang extends Controller
{
    public function index(Request $request)
    {
        return view('admin/datauser/magang', [
            'title' => 'Data Magang'
        ]);
    }
}
