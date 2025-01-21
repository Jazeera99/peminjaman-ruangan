<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\User;

class DashBoardController extends Controller
{
    public function dashboard($role)
    {
        // Daftar view yang valid
        $views = [
            'peminjam' => 'dashboard.peminjam',
            'admin' => 'dashboard.admin',
            'baak' => 'dashboard.baak',
            'sarpras' => 'dashboard.sarpras',
        ];

        // Cek apakah role ada dalam daftar view
        if (!array_key_exists($role, $views)) {
            abort(404); // Tampilkan error 404 jika role tidak valid
        }

        return view($views[$role]);
    }


    public function KalendarReservasi($role)
    {
        return view('kalendar-reservasi', ['role' => $role]);
    }

    public function userProfil()
    {
        return view('user.profil');
    }

    public function ShowFormBooking()
    {
        $ruangans = Ruangan::all();

        return view('form.form-booking', compact('ruangans'));
    }

    public function ShowFormRuangan()
    {
        $ruangans = Ruangan::all();
        // Kirim data ke view
        return view('form.form-tambah-ruangan', compact('ruangans'));
    }

    public function ShowFormUser()
    {
        return view('form.form-tambah-user');
    }

    public function showlistruangan()
    {
        $ruangans = Ruangan::all();

        return view('list.data-ruangan', compact('ruangans') );
    }
    public function showlistuser()
    {
        $users = User::all();

        // Mengirim data ke view
        return view('list.data-user', compact('users'));
    }

    // public function tableUserBaak()
    // {
    //     return view('table.user-baak');
    // }

    // public function tableUserSarpras()
    // {
    //     return view('table.user-sarpras');
    // }

    // public function tableruangan()
    // {
    //     return view('table.total-ruangan');
    // }

    // public function TableUser()
    // {
    //     return view('table.total-user');
    // }
}
