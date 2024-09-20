<?php

namespace App\Http\Controllers\User\AktifitasUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Upload extends Controller
{
    public function Index(Request $request)
    {
        return view('user/aktifitas/uploadaktifitas', [
            'title' => 'Upload Aktifitas',
        ]);
    }
}
