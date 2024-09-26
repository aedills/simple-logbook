<?php

namespace App\Http\Controllers;

use App\Models\AktifitasModel;
use App\Models\DataUser;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class User extends Controller
{
    public function index()
    {
        if (Carbon::now()->format('Y-m-d') > session('tgl_selesai')) {
            $today = Carbon::parse(session('tgl_selesai'));
            $status = false;
        } else {
            $status = true;
            $today = Carbon::now();
        }

        $startOfWeek = $today->copy()->startOfWeek();
        $endOfWeek = $today->isAfter(Carbon::now()->endOfWeek(Carbon::FRIDAY)) ? Carbon::now()->endOfWeek(Carbon::FRIDAY) : $today;

        $recent = AktifitasModel::whereDate('tanggal', $today)->where('uuid_user', session('uuid'))->orderBy('created_at', 'desc')->get();
        $aktifitas = AktifitasModel::whereBetween('tanggal', [$startOfWeek, $endOfWeek])->where('uuid_user', session('uuid'))->selectRaw('DATE(tanggal) as day, COUNT(*) as count')->groupBy('day')->orderBy('day', 'asc')->get();

        return view('user/dashboarduser', [
            'title' => 'Dashboard',
            'total' => AktifitasModel::where('uuid_user', session('uuid'))->count(),
            'totalPending' => AktifitasModel::where('uuid_user', session('uuid'))->where('is_verified', 0)->count(),
            'totalAcc' => AktifitasModel::where('uuid_user', session('uuid'))->where('is_verified', 1)->count(),
            'recent' => $recent,
            'data' => $aktifitas,
            'status' => $status
        ]);
    }

    public function profile()
    {
        return view('user/profileuser', [
            'title' => 'Profile',
            'profile' => DataUser::find(session('id')),
            'aktifitas' => AktifitasModel::where('uuid_user', session('uuid'))->where('is_verified', 1)->count(),
            'pending' => AktifitasModel::where('uuid_user', session('uuid'))->where('is_verified', 0)->count(),
        ]);
    }

    public function login()
    {
        return view('user/loginuser', [
            'title' => 'Login',
        ]);
    }

    public function updateProfile(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:100',
                'username' => 'required|string|max:25',
                'profile' => 'nullable|file|max:5120'
            ]);

            $user = DataUser::find(session('id'));

            $user->nama = $request->nama;
            $user->username = $request->username;

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
                $oldID = session('id');
                $request->session()->flush();
                $request->session()->regenerate();

                $newUserData = DataUser::find($oldID);

                $request->session()->put([
                    'uuid'   => $newUserData->uuid,
                    'id'   => $newUserData->id,
                    'nama' => $newUserData->nama,
                    'username' => $newUserData->username,
                    'role' => $newUserData->role,
                    'foto' => $newUserData->foto,
                    'tgl_mulai' => $newUserData->tgl_mulai,
                    'tgl_selesai' => $newUserData->tgl_selesai,
                ]);

                return back()->with('success', 'Berhasil memperbarui profile');
            } else {
                return back()->with('error', 'Gagal memperbarui profile')->withInput();
            }
        } catch (ValidationException) {
            return back()->with('error', 'Terdapat kesalahan pada input form')->withInput();
        } catch (\Exception $err) {
            return back()->with('error', 'Terdapat kesalahan ketika memperbarui profile')->withInput();
        }
    }

    public function changepass()
    {
        return view('user/changepass', [
            'title' => 'Ganti Password',
        ]);
    }


    public function downloadAktifitasPDF($uuid)
    {
        $dataUser = DataUser::find(session('id'));
        $dataAktifitas = AktifitasModel::where('uuid_user', $uuid)->orderBy('tanggal')->get();

        $tglMulai = $dataUser->tgl_mulai;
        $tglSelesai = $dataUser->tgl_selesai;

        $listTanggal = $this->rangeTanggal($tglMulai, '2024-10-1');

        $pdf = PDF::loadView('pdf_template', compact('dataUser', 'dataAktifitas', 'listTanggal'));
        // return view('pdf_template', [
        //     'dataUser' => $dataUser,
        //     'dataAktifitas' => $dataAktifitas,
        //     'listTanggal' => $listTanggal,
        // ]);
        return $pdf->download('document.pdf');
    }

    private function rangeTanggal($tanggalMulai, $tanggalSelesai)
    {
        $tglMulai = new DateTime($tanggalMulai);
        $tglSelesai = new DateTime($tanggalSelesai);

        $listTanggal = [];
        $listMinggu = 1;

        while ($tglMulai <= $tglSelesai) {
            $tanggalMinggu = [];

            for ($i = 0; $i < 7; $i++) {
                if ($tglMulai > $tglSelesai) break;
                $tanggalMinggu[] = $tglMulai->format('d-m-Y');
                $tglMulai->modify('+1 day');
            }

            $listTanggal["Minggu ke $listMinggu"] = $tanggalMinggu;

            $listMinggu++;
        }

        return $listTanggal;
    }
}
