<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AktifitasModel;

class Aktifitas extends Controller
{
    public function index(Request $request)
    {
        $aktifitas = AktifitasModel::all();

        return view('admin/aktifitas/index', [
            'title' => 'Aktifitas',
            'aktifitas' => $aktifitas,
        ]);
    }
}
