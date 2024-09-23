<?php

namespace App\Http\Controllers\Aktifitas;

use App\Http\Controllers\Controller;
use App\Models\AktifitasModel;
use Illuminate\Http\Request;

class Aktifitas extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan data dengan is_verified = 1
        $aktifitas = AktifitasModel::where('is_verified', 1)->get();

        return view('admin/aktifitas/index', [
            'title' => 'Aktifitas',
            'aktifitas' => $aktifitas
        ]);
    }

    
}
