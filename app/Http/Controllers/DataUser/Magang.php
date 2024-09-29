<?php

namespace App\Http\Controllers\DataUser;

use App\Http\Controllers\Controller;
use App\Models\DataUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class Magang extends Controller
{
    public function index(Request $request)
    {
        return view('admin/datauser/magang', [
            'title' => 'Data Magang',
            'magang' => DataUser::where('role', '=', 'magang')->get()
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:100',
                'username' => 'required|string|max:25|unique:data_user,username',
                'role' => 'required|string|max:100',
                'tgl_mulai' => 'required|date',
                'tgl_selesai' => 'required|date',
                'profile' => 'nullable|file|max:5120'
            ]);

            if(strtolower($request->username) == 'admin'){
                return back()->with('error', 'Anda tidak boleh menggunakan username tersebut!')->withInput();
            }

            $user = new DataUser();

            $user->uuid = Str::uuid();
            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->p4ssw0rd = Hash::make($request->username);
            $user->is_change_pass = 0;
            $user->tgl_mulai = $request->tgl_mulai;
            $user->tgl_selesai = $request->tgl_selesai;
            $user->role = 'magang';

            if ($request->file('profile')) {
                $profile = $request->file('profile');
                $extension = $profile->getClientOriginalExtension();
                $cleanedFilename = Str::slug(pathinfo($profile->getClientOriginalName(), PATHINFO_FILENAME));
                $profilename = uniqid() . $cleanedFilename . '.' . $extension;
                $profilePath = 'assets/profiles/';
                $profile->move($profilePath, $profilename);

                $user->foto = $profilename;
            }

            $result = $user->save();

            if ($result) {
                return back()->with('success', 'Berhasil menambahkan data');
            } else {
                return back()->with('error', 'Gagal menambahkan data')->withInput();
            }
        } catch (ValidationException) {
            return back()->with('error', 'Terdapat kesalahan pada input form')->withInput();
        } catch (QueryException $err) {
            if ($err->getCode() == 23000) {
                return back()->with('error', 'Username telah digunakan.')->withInput();
            }
            return back()->with('error', 'Terdapat kesalahan ketika menambahkan data')->withInput();
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan ketika menambahkan data')->withInput();
        }
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string',
                'nama' => 'required|string|max:100',
                'username' => 'required|string|max:25|unique:data_user,username',
                'role' => 'required|string|max:100',
                'tgl_mulai' => 'required|date',
                'tgl_selesai' => 'required|date',
                'profile' => 'nullable|file|max:5120'
            ]);

            if(strtolower($request->username) == 'admin'){
                return back()->with('error', 'Anda tidak boleh menggunakan username tersebut!')->withInput();
            }

            $user = DataUser::find($request->id);

            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->tgl_mulai = $request->tgl_mulai;
            $user->tgl_selesai = $request->tgl_selesai;

            $oldFoto = $user->foto;

            if ($request->file('profile')) {
                $profile = $request->file('profile');
                $extension = $profile->getClientOriginalExtension();
                $cleanedFilename = Str::slug(pathinfo($profile->getClientOriginalName(), PATHINFO_FILENAME));
                $profilename = uniqid() . $cleanedFilename . '.' . $extension;
                $profilePath = 'assets/profiles/';
                $profile->move(public_path($profilePath), $profilename);

                $user->foto = $profilename;

                if ($oldFoto && $oldFoto != 'default.png') {
                    if (file_exists(public_path($profilePath . $oldFoto))) {
                        unlink(public_path($profilePath . $oldFoto));
                    }
                }
            }

            $result = $user->save();

            if ($result) {
                return back()->with('success', 'Berhasil memperbarui data');
            } else {
                return back()->with('error', 'Gagal memperbarui data')->withInput();
            }
        } catch (ValidationException) {
            return back()->with('error', 'Terdapat kesalahan pada input form')->withInput();
        } catch (QueryException $err) {
            if ($err->getCode() == 23000) {
                return back()->with('error', 'Username telah digunakan.')->withInput();
            }
            return back()->with('error', 'Terdapat kesalahan ketika menambahkan data')->withInput();
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan ketika memperbarui data')->withInput();
        }
    }

    public function delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string|max:255'
            ]);

            $user = DataUser::find($request->id);

            if ($user) {
                if ($user->foto != 'default.png') {
                    unlink(public_path('assets/profiles/' . $user->foto));
                }
                $user->delete();
                return back()->with('success', 'Berhasil menghapus data');
            } else {
                return back()->with('error', 'Data tidak ditemukan')->withInput();
            }
        } catch (ValidationException) {
            return back()->with('error', 'Terdapat kesalahan pada parameter data')->withInput();
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan ketika menghapus data')->withInput();
        }
    }
}
