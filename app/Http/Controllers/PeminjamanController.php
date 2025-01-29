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
                    $query->whereIn('gedung', ['GOR', 'FLTB', 'Anggrek', 'Auditorium']);
                });
            })
            ->when($role == 'baak', function ($query) {
                return $query->whereHas('room', function ($query) {
                    $query->where('gedung', 'Pendidikan');
                });
            })
            ->when($role == 'admin', function ($query) {
                return $query;
            })
            ->when($role == 'peminjam', function ($query) {
                return $query->where('user_id', Auth::id());
            })
            ->get();

        return view('list.list-booking', compact('peminjamanRuangans'));
    }



    public function downloadExcel(Request $request)
    {
        $query = Peminjaman::with(['room', 'user'])
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
            });

        return Excel::download(new PeminjamanExport($query->get()), 'peminjaman.xlsx');
    }




    public function downloadPdf(Request $request)
    {
        $peminjaman = Peminjaman::with(['room', 'user'])
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
        // Cari peminjaman berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($id);

        // Update status peminjaman
        $peminjaman->status = $request->input('status');

        // Jika status ditolak, simpan alasan
        if ($request->input('status') == 'ditolak') {
            $peminjaman->alasan_ditolak = $request->input('alasan_ditolak');
        } else {
            // Kosongkan alasan jika status bukan ditolak
            $peminjaman->alasan_ditolak = null;
        }

        $peminjaman->save();

        // Redirect kembali ke halaman dengan pesan sukses
        return redirect()->route('peminjaman.index')->with('success', 'Status peminjaman berhasil diperbarui.');
    }
}
