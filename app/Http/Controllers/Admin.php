<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
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

            $admin = DataUser::where('username', $request->input('username'))->first();

            if ($admin && Hash::check($request->input('password'), $admin->p4ssw0rd)) {
                $request->session()->put([
                    'uuid'   => $admin->uuid,
                    'nama' => $admin->nama,
                    'username' => $admin->username,
                    'role' => $admin->role,
                    'foto' => $admin->foto,
                ]);

                return redirect()->route('admin.dashboard');
            }
        } catch (ValidationException) {
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
