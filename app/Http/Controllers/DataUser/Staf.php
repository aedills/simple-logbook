<?php

namespace App\Http\Controllers\DataUser;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class Staf extends Controller
{
    public function index(Request $request)
    {
        return view('admin/datauser/staf', [
            'title' => 'Data Staf',
            'staf' => Admin::where('role', '=', 'staf')->get()
        ]);
    }
}
