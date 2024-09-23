<?php

namespace App\Http\Controllers\Aktifitas;

use App\Http\Controllers\Controller;
use App\Models\AktifitasModel;
use Illuminate\Http\Request;

class AktifitasPending extends Controller
{
    public function index(Request $request)
{
    $aktifitas = AktifitasModel::where('is_verified', 0)->join('data_user', 'data_user.uuid', '=', 'data_aktifitas.uuid_user')
    ->orderBy('data_aktifitas.created_at', 'desc')
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

    return view('admin/aktifitas/pending', [
        'title' => 'Aktifitas Pending',
        'aktifitas' => $aktifitas
    ]);
}

public function updateStatus(Request $request)
{
    $aktifitas = AktifitasModel::where('id', $request->id)->first();

    if ($aktifitas) {
        $aktifitas->is_verified = 1;
        $aktifitas->save();
        return  back()->with('success', 'Berhasil Memverifikasi');
    }
    else{
        return back()->with('error', 'tidak berhasil')->withInput();
    }

}


}
