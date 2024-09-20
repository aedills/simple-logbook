<?php

namespace App\Http\Controllers\Aktifitas;

use App\Http\Controllers\Controller;
use App\Models\AktifitasModel;
use Illuminate\Http\Request;

class Aktifitas extends Controller
{
    public function index(Request $request)
    {
        return view('admin/aktifitas/index', [
            'title' => 'Aktifitas',
            'aktifitas' => AktifitasModel::all()
        ]);
    }
}
