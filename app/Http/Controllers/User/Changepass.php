<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DataUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Changepass extends Controller
{
    public function Index(Request $request)
    {
        try {
            $user = DataUser::where('username', $request->session()->get('username'))->first();

            if ($user->is_change_pass) {
                return redirect()->route('user.dashboarduser');
            }
            return view('user/changepass', [
                'title' => 'Ganti Password',
            ]);
        } catch (ValidationException $e) {
            return back()->with('error', 'Terdapat kesalahan pada input form')->withInput();
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan ketika melakukan login')->withInput();
        }
    }

    public function doChangePass(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required|string|max:255',
            ]);

            $user = DataUser::where('username', $request->session()->get('username'))->first();

            if (Hash::check($request->password, $user->p4ssw0rd)) {
                return back()->with('error', 'Password yang kamu masukkan tidak berubah!')->withInput();
            } else {
                $user->p4ssw0rd = Hash::make($request->password);
                $user->is_change_pass = 1;
                $user->save();

                return redirect()->route('user.dashboarduser')->with('success', 'Berhasil mengubah password. Gunakan password baru Anda untuk login berikutnya.');
            }
        } catch (ValidationException $e) {
            return back()->with('error', 'Terdapat kesalahan pada input form')->withInput();
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan ketika melakukan login')->withInput();
        }
    }
}
