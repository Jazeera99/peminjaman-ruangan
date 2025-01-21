<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Dapatkan role dari pengguna yang sedang login
        $role = Auth::user()->role;

        // Ambil data peminjaman berdasarkan role, dengan relasi ke 'room' dan 'user'
        $peminjamanRuangans = Peminjaman::with(['room', 'user']) // Eager load relasi ke 'room' dan 'user'
            ->when($role == 'sarpras', function ($query) {
                // Sarpras hanya bisa melihat ruangan FLTB Anggrek dan Auditorium
                return $query->whereHas('room', function ($query) {
                    $query->whereIn('gedung', ['Anggrek', 'Auditorium']);
                });
            })
            ->when($role == 'baak', function ($query) {
                // BAAK hanya bisa melihat ruangan Gedung Pendidikan
                return $query->whereHas('room', function ($query) {
                    $query->where('gedung', 'Pendidikan');
                });
            })
            ->get();

        return view('list.list-booking', compact('peminjamanRuangans'));
    }
}
