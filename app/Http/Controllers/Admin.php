<?php

namespace App\Http\Controllers;

use App\Models\Admin as ModelsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
            'title' => 'Profile',
            'profile' => ModelsAdmin::find(session('id')),
        ]);
    }

    public function login(Request $request)
    {
        if (session('uuid')) {
            if (session('role') == 'magang' || session('role') == 'pkl') {
                return redirect()->route('user.dashboarduser')->with('error', 'Anda telah login.')->withInput();
            }
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
                        return redirect()->route('auth.changePass')->with('success', 'Berhasil Login. Harap ubah password Anda terlebih dahulu');
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

    public function doUpdateProfile(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:100',
                'username' => 'required|string|max:25',
                'profile' => 'file|max:5120'
            ]);

            $staf = ModelsAdmin::find(session('id'));

            $staf->nama = $request->nama;
            $staf->username = $request->username;

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
                $oldID = session('id');
                $request->session()->flush();
                $request->session()->regenerate();

                $newAdminData = ModelsAdmin::find($oldID);

                $request->session()->put([
                    'id'   => $newAdminData->id,
                    'uuid'   => $newAdminData->uuid,
                    'nama' => $newAdminData->nama,
                    'username' => $newAdminData->username,
                    'role' => $newAdminData->role,
                    'foto' => $newAdminData->foto,
                ]);

                return back()->with('success', 'Berhasil memperbarui data');
            } else {
                return back()->with('error', 'Gagal memperbarui data')->withInput();
            }
        } catch (ValidationException $e) {
            return back()->with('error', 'Terdapat kesalahan pada input form')->withInput();
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan ketika memperbarui data')->withInput();
        }
    }

    public function doUpdatePassword(Request $request)
    {
        try {
            $request->validate([
                'currentPassword' => 'required|string|max:255',
                'newPassword' => 'required|string|max:255',
                'newPasswordConfirm' => 'required|string|max:255',
            ]);

            $user = ModelsAdmin::find(session('id'));

            if (Hash::check($request->currentPassword, $user->p4ssw0rd)) {
                if ($request->newPassword === $request->newPasswordConfirm) {
                    $user->p4ssw0rd = Hash::make($request->newPasswordConfirm);
                    $status = $user->save();

                    if ($status) {
                        return back()->with('success', 'Berhasil memperbarui password');
                    } else {
                        return back()->with('error', 'Terdapat kesalahan ketika memperbarui password')->withInput();
                    }
                } else {
                    return back()->with('error', 'Password baru tidak sesuai')->withInput();
                }
            } else {
                return back()->with('error', 'Password yang Anda masukkan salah! Silahkan coba lagi.')->withInput();
            }
        } catch (ValidationException $e) {
            return back()->with('error', 'Terdapat kesalahan pada input form')->withInput();
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan ketika melakukan update password')->withInput();
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('auth.login')->with('success', 'Anda berhasil keluar!');
    }
}
