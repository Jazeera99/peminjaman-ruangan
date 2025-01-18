<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;

class DashBoardController extends Controller
{
    public function PeminjamDashboard()
    {
        return view('dashboard.peminjam');
    }

    public function adminDashboard()
    {
        return view('dashboard.admin');
    }

    public function dashboardBaak()
    {
        return view('dashboard.baak');
    }

    public function dashboardSarpras()
    {
        return view('dashboard.sarpras');
    }
    
    public function KalendarReservasi($role)
    {
        return view('kalendar-reservasi', ['role' => $role]);
    }

    public function userProfil()
    {
        return view('user.profil');
    }

    public function FormBooking()
    {
        $ruangans = Ruangan::all();

        return view('form.form-booking', compact('ruangans'));
    }

    public function formTambahRuangan()
    {
        $ruangans = Ruangan::all();
        // Kirim data ke view
        return view('form.form-tambah-ruangan', compact('ruangans'));
    }

    public function formTambahUser()
    {
        return view('form.form-tambah-user');
    }

    public function tableUserBaak()
    {
        return view('table.user-baak');
    }

    public function tableUserSarpras()
    {
        return view('table.user-sarpras');
    }
}
