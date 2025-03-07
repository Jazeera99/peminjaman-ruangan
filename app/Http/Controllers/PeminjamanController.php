<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Exports\PeminjamanExport;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $role = Auth::user()->role;

        $peminjamanRuangans = Peminjaman::with(['room', 'user'])
            ->when($request->has('month') && $request->month != '', function ($query) use ($request) {
                return $query->whereMonth('tanggal_kegiatan', $request->month);
            })
            ->when($request->has('year') && $request->year != '', function ($query) use ($request) {
                return $query->whereYear('tanggal_kegiatan', $request->year);
            })
            ->when($request->has('search') && $request->search != '', function ($query) use ($request) {
                return $query->where(function ($query) use ($request) {
                    $query->orWhere('nama_peminjam', 'like', '%' . $request->search . '%')
                        ->orWhere('nama_ormawa', 'like', '%' . $request->search . '%')
                        ->orWhere('nama_kegiatan', 'like', '%' . $request->search . '%')
                        ->orWhere('nama_ruangan', 'like', '%' . $request->search . '%')
                        ->orWhere('nomor_Whatsapp', 'like', '%' . $request->search . '%')
                        ->orWhere('keterangan', 'like', '%' . $request->search . '%')
                        ->orWhere('status', 'like', '%' . $request->search . '%');
                });
            })
            ->when($role == 'sarpras', function ($query) {
                return $query->whereHas('room', function ($query) {
                    $query->whereIn('gedung', ['GOR', 'Anggrek', 'Auditorium']);
                });
            })
            ->when($role == 'baak', function ($query) {
                return $query->whereHas('room', function ($query) {
                    $query->whereIn('gedung', ['Pendidikan', 'FLTB']);
                });
            })
            ->when($role == 'admin', function ($query) {
                return $query;
            })
            ->when($role == 'peminjam', function ($query) {
                return $query->where('user_id', Auth::id());
            })
            ->orderBy('tanggal_kegiatan', 'asc') // Mengurutkan berdasarkan tanggal terbaru
            ->orderBy('waktu_mulai', 'asc')      // Jika tanggal sama, urutkan berdasarkan waktu mulai
            ->get();

        return view('list.list-booking', compact('peminjamanRuangans'));
    }



    public function downloadExcel(Request $request)
    {
        $role = Auth::user()->role;

        $query = Peminjaman::with(['room', 'user'])
            ->when($request->has('month') && $request->month != '', function ($query) use ($request) {
                return $query->whereMonth('tanggal_kegiatan', $request->month);
            })
            ->when($request->has('year') && $request->year != '', function ($query) use ($request) {
                return $query->whereYear('tanggal_kegiatan', $request->year);
            })
            ->when($request->has('search') && $request->search != '', function ($query) use ($request) {
                return $query->where(function ($query) use ($request) {
                    $query->where('nama_peminjam', 'like', '%' . $request->search . '%')
                        ->orWhere('nama_ormawa', 'like', '%' . $request->search . '%')
                        ->orWhere('nama_kegiatan', 'like', '%' . $request->search . '%')
                        ->orWhere('nama_ruangan', 'like', '%' . $request->search . '%')
                        ->orWhere('nomor_Whatsapp', 'like', '%' . $request->search . '%')
                        ->orWhere('keterangan', 'like', '%' . $request->search . '%')
                        ->orWhere('status', 'like', '%' . $request->search . '%');
                });
            })
            ->when($role == 'sarpras', function ($query) {
                return $query->whereHas('room', function ($query) {
                    $query->whereIn('gedung', ['GOR', 'Anggrek', 'Auditorium']);
                });
            })
            ->when($role == 'baak', function ($query) {
                return $query->whereHas('room', function ($query) {
                    $query->whereIn('gedung', ['Pendidikan', 'FLTB']);
                });
            });

        return Excel::download(new PeminjamanExport($query->get()), 'peminjaman.xlsx');
    }

    public function downloadPdf(Request $request)
    {
        $role = Auth::user()->role;

        $peminjaman = Peminjaman::with(['room', 'user'])
            ->when($request->has('month') && $request->month != '', function ($query) use ($request) {
                return $query->whereMonth('tanggal_kegiatan', $request->month);
            })
            ->when($request->has('year') && $request->year != '', function ($query) use ($request) {
                return $query->whereYear('tanggal_kegiatan', $request->year);
            })
            ->when($request->has('search') && $request->search != '', function ($query) use ($request) {
                return $query->where(function ($query) use ($request) {
                    $query->where('nama_peminjam', 'like', '%' . $request->search . '%')
                        ->orWhere('nama_ormawa', 'like', '%' . $request->search . '%')
                        ->orWhere('nama_kegiatan', 'like', '%' . $request->search . '%')
                        ->orWhere('nama_ruangan', 'like', '%' . $request->search . '%')
                        ->orWhere('nomor_Whatsapp', 'like', '%' . $request->search . '%')
                        ->orWhere('keterangan', 'like', '%' . $request->search . '%')
                        ->orWhere('status', 'like', '%' . $request->search . '%');
                });
            })
            ->when($role == 'sarpras', function ($query) {
                return $query->whereHas('room', function ($query) {
                    $query->whereIn('gedung', ['GOR', 'Anggrek', 'Auditorium']);
                });
            })
            ->when($role == 'baak', function ($query) {
                return $query->whereHas('room', function ($query) {
                    $query->whereIn('gedung', ['Pendidikan', 'FLTB']);
                });
            })
            ->get();

        // Buat HTML untuk PDF
        $html = '
    <h2 style="text-align: center;">Laporan Peminjaman Ruangan</h2>
    <table border="1" width="100%" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Ruangan</th>
                <th>Peminjam</th>
                <th>Organisasi</th>
                <th>Nama Kegiatan</th>
                <th>No WhatsApp</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Pas Foto</th>
                <th>File Tambahan</th>
            </tr>
        </thead>
        <tbody>';

        foreach ($peminjaman as $data) {
            $pas_foto = $data->pas_foto ? '<img src="' . asset('storage/' . $data->pas_foto) . '" width="50">' : '-';
            $file_tambahan = $data->file_tambahan ? '<a href="' . asset('storage/' . $data->file_tambahan) . '">Download</a>' : '-';

            $html .= '<tr>
            <td>' . $data->id . '</td>
            <td>' . $data->tanggal_kegiatan . '</td>    
            <td>' . $data->waktu_mulai . '</td>
            <td>' . $data->waktu_selesai . '</td>
            <td>' . ($data->room->nama ?? '-') . '</td>
            <td>' . $data->nama_peminjam . '</td>
            <td>' . ($data->user->nama ?? '-') . '</td>
            <td>' . $data->nama_kegiatan . '</td>
            <td>' . $data->nomor_Whatsapp . '</td>
            <td>' . $data->keterangan . '</td>
            <td>' . $data->status . '</td>
            <td>' . $pas_foto . '</td>
            <td>' . $file_tambahan . '</td>
        </tr>';
        }

        $html .= '</tbody></table>';

        // Generate PDF langsung tanpa view
        $pdf = Pdf::loadHTML($html);
        return $pdf->download('peminjaman.pdf');
    }




    public function getEvents()
    {
        $events = Peminjaman::select('id', 'nama_ruangan', 'nama_kegiatan', 'tanggal_kegiatan', 'waktu_mulai', 'waktu_selesai')
            ->where('status', 'disetujui')  // Menambahkan kondisi status "disetujui"
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->nama_kegiatan,
                    'start' => $event->tanggal_kegiatan . 'T' . $event->waktu_mulai,
                    'end' => $event->tanggal_kegiatan . 'T' . $event->waktu_selesai,
                    'extendedProps' => [
                        'ruangan' => $event->nama_ruangan,
                        'peminjam' => $event->nama_kegiatan
                    ]
                ];
            });

        return response()->json($events);
    }



    public function getEventsByDate(Request $request)
    {
        if ($request->has('date')) {
            $events = Peminjaman::whereDate('tanggal_kegiatan', $request->date)
                ->where('status', 'disetujui')  // Menambahkan kondisi status "disetujui"
                ->select('nama_ruangan', 'nama_kegiatan', 'nama_ormawa', 'waktu_mulai', 'waktu_selesai')
                ->get();

            return response()->json($events);
        }

        return response()->json([]);
    }



    public function updateStatus(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($request->status === 'disetujui') {
            $peminjaman->status = 'disetujui';
            $peminjaman->alasan_disetujui = $request->reason;  // Store the approval reason
        } elseif ($request->status === 'ditolak') {
            $peminjaman->status = 'ditolak';
            $peminjaman->alasan_ditolak = $request->reason;  // Store the rejection reason
        }

        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Status peminjaman berhasil diperbarui');
    }

    public function homeStats()
    {
        $today = now()->format('Y-m-d');
        $currentTime = now()->format('H:i:s');

        // Get only rooms with status 'tersedia'
        $total_ruangan = Ruangan::where('status', 'tersedia')->count();

        // Get booked room names for today
        $booked_room_names = Peminjaman::whereDate('tanggal_kegiatan', $today)
            ->where('status', 'disetujui')
            ->where(function ($query) use ($currentTime) {
                $query->where(function ($q) use ($currentTime) {
                    // Room is currently in use
                    $q->where('waktu_mulai', '<=', $currentTime)
                        ->where('waktu_selesai', '>=', $currentTime);
                })->orWhere(function ($q) use ($currentTime) {
                    // Room is booked for later today
                    $q->where('waktu_mulai', '>', $currentTime);
                });
            })
            ->pluck('nama_ruangan')
            ->toArray();

        // Get available rooms (excluding booked rooms and rooms with status 'tidak tersedia')
        $available_rooms = Ruangan::where('status', 'tersedia')
            ->whereNotIn('nama', $booked_room_names)
            ->get();

        $stats = [
            'total_ruangan' => $total_ruangan,
            'ruangan_tersedia' => $available_rooms->count(),
            'peminjaman_hari_ini' => Peminjaman::whereDate('tanggal_kegiatan', $today)
                ->where('status', 'disetujui')
                ->count()
        ];

        return view('home', compact('stats', 'available_rooms'));
    }

    public function cancel(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status === 'PENDING') {
            $peminjaman->status = 'dibatalkan';
            $peminjaman->save();

            return redirect()->route('dashboard', ['role' => 'peminjam'])->with('success', 'Peminjaman berhasil dibatalkan');
        }

        return redirect()->route('dashboard', ['role' => 'peminjam'])->with('error', 'Peminjaman tidak dapat dibatalkan');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if (in_array(Auth::user()->role, ['admin', 'sarpras', 'baak']) && $peminjaman->status === 'dibatalkan') {
            $peminjaman->delete();
            return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus');
        }

        return redirect()->route('peminjaman.index')->with('error', 'Peminjaman tidak dapat dihapus');
    }
}
