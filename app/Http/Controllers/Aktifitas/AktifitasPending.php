<?php

namespace App\Http\Controllers\Aktifitas;

use App\Http\Controllers\Controller;
use App\Models\AktifitasModel;
use Illuminate\Http\Request;

class AktifitasPending extends Controller
{
    public function index(Request $request)
{
    // Menampilkan data dengan is_verified = 0 (aktifitas yang belum diverifikasi)
    $aktifitas = AktifitasModel::where('is_verified', 0)->get();

    return view('admin/aktifitas/pending', [
        'title' => 'Aktifitas Pending',
        'aktifitas' => $aktifitas
    ]);
}

public function updateStatus($uuid)
{
 // Debugging untuk melihat UUID yang diterima
    $aktifitas = AktifitasModel::where('uuid', $uuid)->first();

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
