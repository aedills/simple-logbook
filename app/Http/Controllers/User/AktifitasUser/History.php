<?php

namespace App\Http\Controllers\User\AktifitasUser;

use App\Http\Controllers\Controller;
use App\Models\DataUser;
use Illuminate\Http\Request;

class History extends Controller
{

    public function Index(Request $request)
    {
        $history = DataUser::where('uuid', session('uuid'))->with('aktifitas')->whereHas('aktifitas', function ($query) {
            $query->where('is_verified', 1);
        })->first();
        return view('user/aktifitas/historyaktifitas', [
            'title' => 'History Aktifitas',
            'history' =>  $history,
        ]);
    }
}
