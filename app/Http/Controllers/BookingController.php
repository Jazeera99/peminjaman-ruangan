<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Ruangan; // Untuk mendapatkan data ruangan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'tanggal_kegiatan' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'room_id' => 'required|exists:ruangans,id',
            'nama_kegiatan' => 'required|string|max:100',
            'jumlah_peserta' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:255',
            'nomor_Whatsapp' => 'required|string|max:15',
            'file' => 'nullable|image|mimes:pdf,doc,docx,jpeg,jpg,png|max:2048',
            'pasFoto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'alasan_ditolak' => 'nullable|string|max:255',
        ]);

        // Cari Ruangan
        $ruangan = Ruangan::findOrFail($request->room_id);

        // Cek Konflik Jadwal
        $conflict = Peminjaman::where('room_id', $ruangan->id)
            ->where('tanggal_kegiatan', $request->tanggal_kegiatan)
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

        // Simpan File
        $filePath = $request->file('file') ? $request->file('file')->store('files', 'public') : null;
        $pasFotoPath = $request->file('pasFoto') ? $request->file('pasFoto')->store('pas_foto', 'public') : null;

        // Simpan Data Peminjaman
        Peminjaman::create([
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'room_id' => $ruangan->id,
            'nama_ruangan' => $ruangan->nama,
            'nama_peminjam' => $request->nama_peminjam,
            'user_id' => Auth::id(),
            'nama_ormawa' => Auth::user()->nama,
            'nama_kegiatan' => $request->nama_kegiatan,
            'jumlah_peserta' => $request->jumlah_peserta,
            'keterangan' => $request->keterangan,
            'nomor_Whatsapp' => $request->nomor_Whatsapp,
            'pas_foto' => $pasFotoPath,
            'file' => $filePath,
            'status' => 'PENDING',
            'alasan_ditolak' => $request->alasan_ditolak,
        ]);

        return redirect()->back()->with('success', 'Peminjaman berhasil ditambahkan!');
    }
}
