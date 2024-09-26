<?php

namespace App\Http\Controllers\User\AktifitasUser;

use App\Http\Controllers\Controller;
use App\Models\AktifitasModel;
use App\Models\DataUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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

    public function update(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string|max:255',
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'gambar' => 'nullable|image|max:10240',
                'tanggal' => 'required'
            ]);


            $kegiatan = AktifitasModel::find($request->id);
            $kegiatan->tanggal = $request->tanggal;
            $kegiatan->judul = $request->judul;
            $kegiatan->keterangan = $request->deskripsi;

            $oldFoto = $kegiatan->foto;

            if ($request->file('gambar')) {
                $image = $request->file('gambar');
                $extension = $image->getClientOriginalExtension();
                $cleanedFilename = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
                $imagename = uniqid() . $cleanedFilename . '.' . $extension;
                $imagePath = 'assets/aktifitasimages/';
                $image->move($imagePath, $imagename);
                $kegiatan->foto = $imagename;

                if (file_exists(public_path($imagePath . $oldFoto))) {
                    unlink(public_path($imagePath . $oldFoto));
                }
            }

            $result = $kegiatan->save();

            if ($result) {
                return back()->with('success', 'Berhasil memperbarui kegiatan!');
            } else {
                return back()->with('error', 'Gagal memperbarui data')->withInput();
            }
        } catch (ValidationException) {
            return back()->with('error', 'Terdapat kesalahan pada input form')->withInput();
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan ketika memperbarui data')->withInput();
        }
    }

    public function delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string|max:255',
                'uuid' => 'required|string|max:255'
            ]);

            $record = AktifitasModel::find($request->id);

            if ($request->uuid == $record->uuid) {
                $status = $record->delete();
                if ($status) {
                    return back()->with('success', 'Berhasil menghapus aktifitas');
                } else {
                    return back()->with('error', 'Gagal menghapus aktifitas')->withInput();
                }
            } else {
                return back()->with('error', 'Input data tidak sesuai')->withInput();
            }
        } catch (ValidationException) {
            return back()->with('error', 'Input id dan uuid diperlukan')->withInput();
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan ketika menghapus data')->withInput();
        }
    }
}
