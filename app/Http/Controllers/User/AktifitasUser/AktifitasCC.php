<?php

namespace App\Http\Controllers\User\AktifitasUser;

use App\Http\Controllers\Controller;
use App\Models\AktifitasModel;
use App\Models\DataUser;
use Illuminate\Http\Request;

class AktifitasCC extends Controller
{
    public function list(Request $request)
    {
        $history = DataUser::where('uuid', session('uuid'))
            ->whereHas('aktifitas', function ($query) {
                $query->where('is_verified', 1)->with('verif_by');
            })
            ->with(['aktifitas' => function ($query) {
                $query->where('is_verified', 1)->with('verif_by')
                    ->orderBy('tanggal', 'desc');
            }])
            ->first();

        return view('user/aktifitas/historyaktifitas', [
            'title' => 'History Aktifitas',
            'history' =>  $history,
            'total' => AktifitasModel::where('uuid_user', session('uuid'))->where('is_verified', 1)->count()
        ]);
    }

    public function pending(Request $request)
    {
        $pending = DataUser::where('uuid', session('uuid'))
            ->whereHas('aktifitas', function ($query) {
                $query->where('is_verified', 0);
            })
            ->with(['aktifitas' => function ($query) {
                $query->where('is_verified', 0)
                    ->orderBy('tanggal', 'desc');
            }])
            ->first();

        return view('user/aktifitas/pendingaktifitas', [
            'title' => 'Pending Aktifitas',
            'pending' =>  $pending,
            'total' => AktifitasModel::where('uuid_user', session('uuid'))->where('is_verified', 0)->count()
        ]);
    }
}
