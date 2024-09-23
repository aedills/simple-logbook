<?php

namespace App\Http\Controllers\User\AktifitasUser;

use App\Http\Controllers\Controller;
use App\Models\User\UploadAktifitas;
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
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'gambar' => 'required|image|max:5120',
                'tanggal' => 'required'
            ]);


            $storeKegiatan = new UploadAktifitas();
            $storeKegiatan->uuid = Str::uuid();
            $storeKegiatan->uuid_user = $request->session()->get('uuid');
            $storeKegiatan->tanggal = $request->tanggal;
            $storeKegiatan->judul = $request->judul;
            $storeKegiatan->keterangan = $request->deskripsi;
            $storeKegiatan->is_verified = 0;

            if ($request->file('gambar')) {
                $image = $request->file('gambar');
                $extension = $image->getClientOriginalExtension();
                $cleanedFilename = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
                $imagename = uniqid() . $cleanedFilename . '.' . $extension;
                $imagePath = 'assets/images/';
                $image->move($imagePath, $imagename);
                $storeKegiatan->foto = $imagename;
            }

            $result = $storeKegiatan->save();

            if (!$result) {
                return back()->with('error', 'Gagal menambahkan data')->withInput();
            }

            return back()->with('success', 'Berhasil menambahkan kegiatan!');
        } catch (ValidationException) {
            return back()->with('error', 'Terdapat kesalahan pada input form')->withInput();
        } catch (\Exception $err) {
            dd($err);
            return back()->with('error', 'Terdapat kesalahan ketika menambahkan data')->withInput();
        }
    }
}
