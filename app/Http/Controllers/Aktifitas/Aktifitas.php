<?php

namespace App\Http\Controllers\Aktifitas;

use App\Http\Controllers\Controller;
use App\Models\AktifitasModel;
use Illuminate\Http\Request;

class Aktifitas extends Controller
{
    public function index(Request $request)
    {
        $aktifitas = AktifitasModel::where('is_verified', 1)->join('data_user', 'data_user.uuid', '=', 'data_aktifitas.uuid_user')
            ->orderBy('data_aktifitas.tanggal', 'desc')
            ->select(
                'data_aktifitas.id',
                'data_aktifitas.uuid',
                'data_aktifitas.uuid_user',
                'data_aktifitas.tanggal',
                'data_aktifitas.judul',
                'data_aktifitas.keterangan',
                'data_aktifitas.foto',
                'data_aktifitas.is_verified',
                'data_user.nama',
            )->get();

        return view('admin/aktifitas/index', [
            'title' => 'Aktifitas',
            'aktifitas' => $aktifitas
        ]);
    }
}
