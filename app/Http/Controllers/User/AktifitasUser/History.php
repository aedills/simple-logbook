<?php

namespace App\Http\Controllers\User\AktifitasUser;

use App\Http\Controllers\Controller;
use App\Models\User\HistoryAktifitas;
use Illuminate\Http\Request;

class History extends Controller
{

    public function Index(Request $request)
    {

        return view('user/aktifitas/historyaktifitas', [
            'title' => 'History Aktifitas',
            'history' =>  HistoryAktifitas::where('uuid_user', $request->session()->get('uuid'))->get(),
        ]);
    }
}
