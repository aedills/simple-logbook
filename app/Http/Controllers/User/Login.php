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

            if ($user && Hash::check($request->input('password'), $user->p4ssw0rd)) {

                $request->session()->put([
                    'uuid'   => $user->uuid,
                    'nama' => $user->nama,
                    'username' => $user->username,
                    'role' => $user->role,
                    'foto' => $user->foto,
                ]);

                if (!$user->is_change_pass) {
                    return redirect()->route('user.changepass');
                }

                return redirect()->route('user.dashboarduser');
            }
        } catch (ValidationException) {
            return back()->with('error', 'Terdapat kesalahan pada input form')->withInput();
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan ketika melakukan login')->withInput();
        }
    }
}
