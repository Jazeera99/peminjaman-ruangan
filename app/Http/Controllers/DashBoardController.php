<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function KalendarReservasi($role)
    {
        return view('kalendar-reservasi', ['role' => $role]);
    }

    public function userProfil()
    {
        return view('user.profil');
    }

    public function userFormBooking()
    {
        return view('form.form-booking');
    }

    public function adminRuangan()
    {
        return view('admin.ruangan');
    }

    public function tableUserBaak()
    {
        return view('table.user-baak');
    }

    public function tableUserSarpras()
    {
        return view('table.user-sarpras');
    }

    public function adminUser()
    {
        return view('admin.user');
    }

    public function dashboardBaak()
    {
        return view('dashboard.baak');
    }

    public function dashboardSarpras()
    {
        return view('dashboard.sarpras');
    }
}
