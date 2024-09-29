<?php

namespace App\Http\Controllers\DataUser;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class Staf extends Controller
{
    public function index(Request $request)
    {
        return view('admin/datauser/staf', [
            'title' => 'Data Staf',
            'staf' => Admin::where('role', '=', 'staf')->get()
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:100',
                'username' => 'required|string|max:25|unique:data_user,username',
                'role' => 'required|string|max:100',
                'profile' => 'file|max:5120'
            ]);

            if(strtolower($request->username) == 'admin'){
                return back()->with('error', 'Anda tidak boleh menggunakan username tersebut!')->withInput();
            }

            $staf = new Admin();

            $staf->uuid = Str::uuid();
            $staf->nama = $request->nama;
            $staf->username = $request->username;
            $staf->p4ssw0rd = Hash::make($request->username);
            $staf->is_change_pass = 0;
            $staf->role = $request->role;

            if ($request->file('profile')) {
                $profile = $request->file('profile');
                $extension = $profile->getClientOriginalExtension();
                $cleanedFilename = Str::slug(pathinfo($profile->getClientOriginalName(), PATHINFO_FILENAME));
                $profilename = uniqid() . $cleanedFilename . '.' . $extension;
                $profilePath = 'assets/profiles/';
                $profile->move($profilePath, $profilename);

                $staf->foto = $profilename;
            }

            $result = $staf->save();

            if ($result) {
                return back()->with('success', 'Berhasil menambahkan data');
            } else {
                return back()->with('error', 'Gagal menambahkan data')->withInput();
            }
        } catch (ValidationException $e) {
            if ($e->validator->errors()->has('username')) {
                return back()->with('error', 'Username telah dogunakan')->withInput();
            }
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
                'profile' => 'file|max:5120'
            ]);

            if(strtolower($request->username) == 'admin'){
                return back()->with('error', 'Anda tidak boleh menggunakan username tersebut!')->withInput();
            }

            $staf = Admin::find($request->id);

            $staf->nama = $request->nama;
            $staf->username = $request->username;
            $staf->is_change_pass = 0;
            $staf->role = $request->role;

            $oldFoto = $staf->foto;

            if ($request->file('profile')) {
                $profile = $request->file('profile');
                $extension = $profile->getClientOriginalExtension();
                $cleanedFilename = Str::slug(pathinfo($profile->getClientOriginalName(), PATHINFO_FILENAME));
                $profilename = uniqid() . $cleanedFilename . '.' . $extension;
                $profilePath = 'assets/profiles/';
                $profile->move(public_path($profilePath), $profilename);

                $staf->foto = $profilename;

                if ($oldFoto && $oldFoto != 'default.png') {
                    if (file_exists(public_path($profilePath . $oldFoto))) {
                        unlink(public_path($profilePath . $oldFoto));
                    }
                }
            }

            $result = $staf->save();

            if ($result) {
                return back()->with('success', 'Berhasil memperbarui data');
            } else {
                return back()->with('error', 'Gagal memperbarui data')->withInput();
            }
        } catch (ValidationException $e) {
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

            $staf = Admin::find($request->id);

            if ($staf) {
                if ($staf->foto != 'default.png') {
                    unlink(public_path('assets/profiles/' . $staf->foto));
                }
                $staf->delete();
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
