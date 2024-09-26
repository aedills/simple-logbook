<?php

namespace App\Http\Controllers\Aktifitas;

use App\Http\Controllers\Controller;
use App\Models\AktifitasModel;
use Illuminate\Http\Request;

class Aktifitas extends Controller
{
    public function index(Request $request)
    {
        $aktifitas = AktifitasModel::where('is_verified', 1)->with(['upload_by', 'verif_by'])
            ->orderBy('data_aktifitas.tanggal', 'desc')
            ->get();


        return view('admin/aktifitas/index', [
            'title' => 'Aktifitas',
            'aktifitas' => $aktifitas
        ]);
    }
}
