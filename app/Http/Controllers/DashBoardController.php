<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

        // Data histori peminjaman (hanya untuk peminjam)
        $peminjamanRuangans = [];
        if ($role === 'peminjam') {
            $peminjamanRuangans = Peminjaman::with(['room', 'user'])
                ->where('user_id', Auth::id()) // Ambil data berdasarkan user yang login
                ->orderBy('tanggal_kegiatan', 'desc') // Gunakan 'tanggal_kegiatan'
                ->get();
        }

        // Data ruangan tidak tersedia (berdasarkan tanggal login)
        $tanggalHariIni = Carbon::today(); // Tanggal hari ini
        $ruanganTidakTersedia = Peminjaman::with('room') // Eager load relasi 'room'
            ->whereDate('tanggal_kegiatan', $tanggalHariIni) // Filter ruangan yang tidak tersedia pada hari ini
            ->where('status', '!=', 'disetujui') // Hanya ambil ruangan dengan status selain 'disetujui'
            ->get();

        return view($views[$role], compact('peminjamanRuangans', 'ruanganTidakTersedia'));
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

    public function ShowFormUser()
    {
        return view('form.form-tambah-user');
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
