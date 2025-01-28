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
        $peminjamanRuangans = Peminjaman::with(['room', 'user'])
            ->when($role == 'sarpras', function ($query) {
                return $query->whereHas('room', function ($query) {
                    $query->whereIn('gedung', ['GOR','FLTB','Anggrek', 'Auditorium']);
                });
            })
            ->when($role == 'baak', function ($query) {
                return $query->whereHas('room', function ($query) {
                    $query->where('gedung', 'Pendidikan');
                });
            })
            ->when($role == 'admin', function ($query) {
                // Admin dapat melihat semua data, tanpa filter
                return $query;
            })
            ->when($role == 'peminjam', function ($query) {
                // Peminjam hanya melihat histori peminjamannya sendiri
                return $query->where('user_id', Auth::id());
            })
            ->get();


        return view('list.list-booking', compact('peminjamanRuangans'));
    }
}
