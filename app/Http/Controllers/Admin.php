<?php

namespace App\Http\Controllers;

use App\Models\Admin as ModelsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Admin extends Controller
{
    public function index(Request $request)
    {
        return view('admin/dashboard', [
            'title' => 'Dashboard'
        ]);
    }

    public function profile(Request $request)
    {
        return view('admin/profile', [
            'title' => 'Profile'
        ]);
    }

    public function login(Request $request)
    {
        if (session('uuid')) {
            return redirect()->route('admin.dashboard')->with('error', 'Anda telah login')->withInput();
        }
        return view('admin/login', [
            'title' => 'Admin | Login'
        ]);
    }

    public function doLogin(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string|max:100',
                'password' => 'required|string|max:255',
            ]);

            $admin = ModelsAdmin::where('username', $request->input('username'))->first();

            if ($admin) {
                if (Hash::check($request->input('password'), $admin->p4ssw0rd)) {

                    $request->session()->put([
                        'id' => $admin->id,
                        'uuid' => $admin->uuid,
                        'nama' => $admin->nama,
                        'username' => $admin->username,
                        'role' => $admin->role,
                        'foto' => $admin->foto,
                    ]);

                    if (!$admin->is_change_pass) {
                        return redirect()->route('auth.changePass');
                    }

                    return redirect()->route('admin.dashboard');
                } else {
                    return back()->with('error', 'Password yang Anda masukkan salah. Silahkan coba lagi.')->withInput();
                }
            } else {
                return back()->with('error', 'User tidak ditemukan. Silahkan hubungi admin.')->withInput();
            }
        } catch (ValidationException) {
            return back()->with('error', 'Terdapat kesalahan pada input form')->withInput();
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan ketika melakukan login')->withInput();
        }
    }

    public function changePass(Request $request)
    {
        if (session('uuid')) {
            return view('admin/changePass', [
                'title' => 'Ganti Password'
            ]);
        } else {
            return redirect()->route('auth.login')->with('error', 'Anda harus login terlebih dahulu!')->withInput();
        }
    }

    public function doChangePass(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required|string|max:255',
            ]);

            $admin = ModelsAdmin::where('uuid', $request->session()->get('uuid'))->first();

            if (Hash::check($request->password, $admin->p4ssw0rd)) {
                return back()->with('error', 'Password yang kamu masukkan tidak berubah! Masukkan password baru Anda.')->withInput();
            } else {
                $admin->p4ssw0rd = Hash::make($request->password);
                $admin->is_change_pass = 1;
                $admin->save();

                return redirect()->route('admin.dashboard')->with('success', 'Berhasil mengubah password');
            }
        } catch (ValidationException $e) {
            return back()->with('error', 'Terdapat kesalahan pada input form')->withInput();
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan ketika melakukan login')->withInput();
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('auth.login')->with('success', 'Anda berhasil keluar!');
    }
}
