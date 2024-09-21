<?php

namespace App\Http\Controllers\User\AktifitasUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class Upload extends Controller
{
    public function Index(Request $request)
    {
        return view('user/aktifitas/uploadaktifitas', [
            'title' => 'Upload Aktifitas',
        ]);
    }

    public function Store(Request $request)
    {
        try {
            // Format tanggal
            $tanggal = date_create($request->tanggal);
            $tanggalFormatted = date_format($tanggal, "d/m/Y");

            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'gambar' => 'required|file|max:2048',
                'tanggal' => 'required'
            ]);
            $validatedData['tanggal'] = $tanggalFormatted;

            $storeKegiatan = new Upload();
            $storeKegiatan->uuid = Str::uuid();
            $storeKegiatan->uuid_user = Str::uuid();
            $storeKegiatan->tanggal = $validatedData['tanggal'];
            $storeKegiatan->judul = $validatedData['judul'];
            $storeKegiatan->keterangan = $validatedData['keterangan'];
            $storeKegiatan->foto = $validatedData['gambar'];
        } catch (ValidationException $e) {
            dd($e);
        }


        // if ($request->file('image')) {
        //     $imagePath = $request->file('image')->store('images', 'public');
        // }
    }
}
