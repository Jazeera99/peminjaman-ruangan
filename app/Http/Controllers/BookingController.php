BOOKING CONTROLLER

<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Ruangan; // Untuk mendapatkan data ruangan
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:100',
            'nomor_Whatsapp' => 'required|string|max:15',
            'ruangan' => 'required|exists:ruangans,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'peminjam' => 'required|string|max:100',
            'nama_kegiatan' => 'required|string|max:100',
            'jumlah_kursi' => 'nullable|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        // Cari ruangan berdasarkan ID
        $ruangan = Ruangan::findOrFail($request->ruangan);

        // Cek apakah ruangan sudah dibooking di waktu dan tanggal tertentu
        $conflict = Peminjaman::where('room_id', $ruangan->id)
            ->where('tanggal_kegiatan', $request->tanggal)
            ->where(function ($query) use ($request) {
                $query->whereBetween('waktu_mulai', [$request->waktu_mulai, $request->waktu_selesai])
                    ->orWhereBetween('waktu_selesai', [$request->waktu_mulai, $request->waktu_selesai])
                    ->orWhere(function ($subQuery) use ($request) {
                        $subQuery->where('waktu_mulai', '<=', $request->waktu_mulai)
                            ->where('waktu_selesai', '>=', $request->waktu_selesai);
                    });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()->with('error', 'Ruangan telah dibooking di waktu dan tanggal tersebut!');
        }

        // Tambahkan data ke tabel peminjaman
        Peminjaman::create([
            'tanggal_kegiatan' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'room_id' => $ruangan->id,
            'nama_ruangan' => $ruangan->nama,
            'nama_peminjam' => $request->nama,
            'nama_ormawa' => $request->peminjam,
            'nama_kegiatan' => $request->nama_kegiatan,
            'jumlah_peserta' => $request->jumlah_peserta,
            'keterangan' => $request->keterangan,
            'nomor_Whatsapp' => $request->nomor_Whatsapp,
        ]);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Peminjaman berhasil ditambahkan!');
    }
}