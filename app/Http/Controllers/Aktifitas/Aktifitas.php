<?php

namespace App\Http\Controllers\Aktifitas;

use App\Http\Controllers\Controller;
use App\Models\AktifitasModel;
use App\Models\DataUser;
use Illuminate\Http\Request;

class Aktifitas extends Controller
{
    public function index(Request $request)
    {
        $aktifitas = AktifitasModel::where('is_verified', 1)->with(['upload_by', 'verif_by'])->orderBy('data_aktifitas.tanggal', 'desc')->get();

        return view('admin/aktifitas/index', [
            'title' => 'Aktifitas',
            'aktifitas' => $aktifitas,
            'user' => DataUser::orderBy('role', 'asc')->get(),

            'form_uuid' => null,
            'form_from' => null,
            'form_to' => null,
        ]);
    }

    public function filter(Request $request)
    {
        $query = AktifitasModel::query();

        if ($request->has('uuid')) {
            $query->where('uuid_user', $request->uuid);
        }

        if ($request->from != null && $request->to != null) {
            $query->whereBetween('tanggal', [$request->from, $request->to]);
        } elseif ($request->from != null) {
            $query->where('tanggal', '>=', $request->from);
        } elseif ($request->to != null) {
            $query->where('tanggal', '<=', $request->to);
        }

        $data = $query->where('is_verified', 1)->with(['upload_by', 'verif_by'])->orderBy('data_aktifitas.tanggal', 'desc')->get();

        return view('admin/aktifitas/index', [
            'title' => 'Aktifitas',
            'aktifitas' => $data,
            'user' => DataUser::orderBy('role', 'asc')->get(),

            'form_uuid' => $request->uuid,
            'form_from' => $request->from,
            'form_to' => $request->to,
        ]);
    }
}
