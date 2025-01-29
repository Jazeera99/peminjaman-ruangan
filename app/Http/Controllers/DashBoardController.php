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
        $ruanganTidakTersedia = Peminjaman::with('room') // Eager load relasi 'ruangan'
            ->whereDate('tanggal_kegiatan', $tanggalHariIni) // Filter ruangan yang tidak tersedia pada hari ini
            ->where('status', '!=', 'disetujui') // Hanya ambil ruangan dengan status selain 'disetujui'
            ->get();

        // Filter ruangan hanya berdasarkan gedung yang ada
        $validGedung = ['Pendidikan', 'FLTB', 'Anggrek', 'GOR', 'Auditorium'];

        // Statistik booking untuk hari ini
        $pendingBookings = Peminjaman::whereDate('tanggal_kegiatan', $tanggalHariIni)->where('status', 'PENDING')->count();
        $ditolakBookings = Peminjaman::whereDate('tanggal_kegiatan', $tanggalHariIni)->where('status', 'ditolak')->count();
        $disetujuiBookings = Peminjaman::whereDate('tanggal_kegiatan', $tanggalHariIni)->where('status', 'disetujui')->count();
        $selesaiBookings = Peminjaman::whereDate('tanggal_kegiatan', $tanggalHariIni)->where('status', 'selesai')->count();
        $totalBookings = $pendingBookings + $ditolakBookings + $disetujuiBookings + $selesaiBookings;

        // User statistics for the dashboard
        $totalUsers = User::count(); // Example for total users
        $baakUsers = User::where('role', 'baak')->count();  // For BAAT users
        $sarprasUsers = User::where('role', 'sarpras')->count();  // For SARPRAS users
        $otherUsers = User::where('role', 'ukm')->count();

        // Ruangan statistics for the dashboard (only from valid gedung)
        $pendidikanRuangan = Ruangan::whereIn('gedung', $validGedung)->where('gedung', 'Pendidikan')->count();  // Pendidikan ruangan
        $fltbRuangan = Ruangan::whereIn('gedung', $validGedung)->where('gedung', 'FLTB')->count();  // FLTB ruangan
        $sarprasRuangan = Ruangan::whereIn('gedung', $validGedung)->where('gedung', 'SARPRAS')->count();  // SARPRAS ruangan
        $anggrekRuangan = Ruangan::whereIn('gedung', $validGedung)->where('gedung', 'Anggrek')->count();  // Anggrek ruangan
        $gorRuangan = Ruangan::whereIn('gedung', $validGedung)->where('gedung', 'GOR')->count();  // GOR ruangan
        $auditoriumRuangan = Ruangan::whereIn('gedung', $validGedung)->where('gedung', 'Auditorium')->count();  // Auditorium ruangan

        return view($views[$role], compact(
            'peminjamanRuangans',
            'ruanganTidakTersedia',
            'pendingBookings',
            'ditolakBookings',
            'disetujuiBookings',
            'selesaiBookings',
            'totalBookings',
            'totalUsers',
            'baakUsers',
            'sarprasUsers',
            'otherUsers',
            'pendidikanRuangan',
            'fltbRuangan',
            'sarprasRuangan',
            'anggrekRuangan',
            'gorRuangan',
            'auditoriumRuangan'
        ));
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

    public function showDashboard()
    {
        $today = Carbon::today();

        // User Statistics
        $totalUsers = User::count();  // Example for total users
        $baakUsers = User::where('role', 'baak')->count();  // For BAAT users
        $sarprasUsers = User::where('role', 'sarpras')->count();  // For SARPRAS users
        $otherUsers = $totalUsers - $baakUsers - $sarprasUsers;

        // Room Statistics
        $vokasiRooms = Ruangan::where('gedung', 'Vokasi')->count();  // Example for vocational rooms
        $fltRooms = Ruangan::where('gedung', 'FLTB')->count();  // FLTB rooms
        $sarprasRooms = Ruangan::where('gedung', 'SARPRAS')->count();  // SARPRAS rooms
        $anggrekRooms = Ruangan::where('gedung', 'Anggrek')->count();  // Anggrek rooms

        // Booking Statistics for today
        $pendingBookings = Peminjaman::whereDate('tanggal_kegiatan', $today)->where('status', 'pending')->count();
        $ditolakBookings = Peminjaman::whereDate('tanggal_kegiatan', $today)->where('status', 'ditolak')->count();
        $disetujuiBookings = Peminjaman::whereDate('tanggal_kegiatan', $today)->where('status', 'disetujui')->count();
        $selesaiBookings = Peminjaman::whereDate('tanggal_kegiatan', $today)->where('status', 'selesai')->count();

        // Total bookings for today
        $totalBookings = $pendingBookings + $ditolakBookings + $disetujuiBookings + $selesaiBookings;

        return view('admin.dashboard', compact(
            'totalUsers',
            'baakUsers',
            'sarprasUsers',
            'otherUsers',
            'vokasiRooms',
            'fltRooms',
            'sarprasRooms',
            'anggrekRooms',
            'pendingBookings',
            'ditolakBookings',
            'disetujuiBookings',
            'selesaiBookings',
            'totalBookings'
        ));
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
