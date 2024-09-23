<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DataUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Login extends Controller
{
    public function index(Request $request)
    {
        return view('user/loginuser', [
            'title' => 'Login',
        ]);
    }

    public function doLogin(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string|max:100',
                'password' => 'required|string|max:255',
            ]);

            $user = DataUser::where('username', $request->input('username'))->first();

            if ($user) {
                if (Hash::check($request->input('password'), $user->p4ssw0rd)) {
                    $request->session()->put([
                        'uuid'   => $user->uuid,
                        'id'   => $user->id,
                        'nama' => $user->nama,
                        'username' => $user->username,
                        'role' => $user->role,
                        'foto' => $user->foto,
                        'tgl_mulai' => $user->tgl_mulai,
                        'tgl_selesai' => $user->tgl_selesai,
                    ]);

                    if (!$user->is_change_pass) {
                        return redirect()->route('user.changepass');
                    }
                    return redirect()->route('user.dashboarduser');
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

    public function logout(Request $request)
    {
        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('auth.userLogin')->with('success', 'Anda berhasil keluar!');
    }
}
