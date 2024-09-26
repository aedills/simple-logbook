<?php

namespace App\Http\Controllers\Aktifitas;

use App\Http\Controllers\Controller;
use App\Models\AktifitasModel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AktifitasPending extends Controller
{
    public function index(Request $request)
    {
        $aktifitas = AktifitasModel::where('is_verified', 0)
            ->join('data_user', 'data_user.uuid', '=', 'data_aktifitas.uuid_user')
            ->orderBy('data_aktifitas.tanggal', 'asc')
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
            $aktifitas->verified_by_uuid = session('uuid');
            $aktifitas->save();
            return  back()->with('success', 'Berhasil Memverifikasi');
        } else {
            return back()->with('error', 'tidak berhasil')->withInput();
        }
    }

    public function updateBulkStatus(Request $request)
    {
        try {
            $request->validate([
                'pendingItem' => 'array|required'
            ]);

            foreach ($request->pendingItem as $id) {
                $item = AktifitasModel::find($id);

                $item->is_verified = 1;
                $item->verified_by_uuid = session('uuid');

                $item->save();
            }

            return back()->with('success', 'Berhasil melakukan verifikasi');
        } catch (ValidationException) {
            return back()->with('error', 'Tidak ada data yang dipilih')->withInput();
        } catch (\Exception) {
            return back()->with('error', 'Terdapat kesalahan ketika mengolah data')->withInput();
        }
    }
}
