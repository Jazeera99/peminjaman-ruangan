<?php

namespace App\Http\Controllers;

use App\Models\ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showlistruangan($role)
    {
        $user = Auth::user();
        $role = $user->role;

        // Admin bisa melihat semua ruangan
        if ($role === 'admin') {
            $ruangans = Ruangan::orderBy('nama', 'asc')->get();
        }
        // Sarpras hanya bisa melihat ruangan dari gedung tertentu
        elseif ($role === 'sarpras') {
            $ruangans = Ruangan::whereIn('gedung', ['GOR', 'Anggrek', 'Auditorium'])
                              ->orderBy('nama', 'asc')
                              ->get();
        }
        // BAAK hanya bisa melihat ruangan di gedung Pendidikan
        elseif ($role === 'baak') {
            $ruangans = Ruangan::whereIn('gedung', ['Pendidikan', 'FLTB'])
                              ->orderBy('nama', 'asc')
                              ->get();
        }
        // Peminjam tidak seharusnya melihat daftar ruangan
        else {
            return abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('list.data-ruangan', compact('ruangans'), ['role' => $role]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function ShowFormRuangan()
    {
        $ruangans = Ruangan::all();
        // Kirim data ke view
        return view('form.form-tambah-ruangan', compact('ruangans'));
    }

    /**
     * Menyimpan ruangan baru sesuai role pengguna.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $role = $user->role;

        // Validasi input
        $validatedData = $request->validate([
            'gedung' => 'required|in:FLTB,Pendidikan,Anggrek,GOR,Auditorium',
            'nama_ruangan' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        // Batasi Sarpras hanya bisa membuat di gedung tertentu
        if ($role === 'sarpras' && !in_array($validatedData['gedung'], ['GOR', 'FLTB', 'Anggrek', 'Auditorium'])) {
            return redirect()->back()->with('error', 'Sarpras hanya dapat mengelola ruangan di GOR, FLTB, Anggrek, Auditorium.');
        }

        // Batasi BAAK hanya bisa membuat di gedung Pendidikan
        if ($role === 'sarpras' && !in_array($validatedData['gedung'], ['Pendidikan', 'FLTB'])) {
            return redirect()->back()->with('error', 'BAAK hanya dapat mengelola ruangan di gedung Pendidikan.');
        }

        // Simpan data ruangan
        Ruangan::create([
            'user_id' => $user->id,
            'gedung' => $validatedData['gedung'],
            'nama' => $validatedData['nama_ruangan'],
            'kapasitas' => $validatedData['kapasitas'],
            'deskripsi' => $validatedData['deskripsi'],
            'status' => 'tersedia',
        ]);

        return redirect()->route('rooms.table', ['role' => Auth::user()->role])
            ->with('success', 'Ruangan berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {}



    /**
     * Update the specified resource in storage.
     */
    /**
     * Mengupdate ruangan dengan Modal Edit.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $role = $user->role;

        // Validasi input
        $validatedData = $request->validate([
            'gedung' => 'required|in:FLTB,Pendidikan,Anggrek,GOR,Auditorium',
            'nama_ruangan' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string|max:255',
            'status' => 'required|in:tersedia,tidak tersedia'
        ]);

        // Ambil data ruangan
        $ruangan = Ruangan::findOrFail($id);

        // Batasi akses berdasarkan role
        if ($role === 'sarpras' && !in_array($validatedData['gedung'], ['GOR', 'Anggrek', 'Auditorium'])) {
            return response()->json(['success' => false, 'message' => 'Sarpras hanya dapat mengelola ruangan di GOR, Anggrek, Auditorium.']);
        }

        if ($role === 'sarpras' && !in_array($validatedData['gedung'], ['Pendidikan', 'FLTB'])) {
            return response()->json(['success' => false, 'message' => 'BAAK hanya dapat mengelola ruangan di gedung Pendidikan, FLTB.']);
        }

        // Update ruangan
        $ruangan->update([
            'gedung' => $validatedData['gedung'],
            'nama' => $validatedData['nama_ruangan'],
            'kapasitas' => $validatedData['kapasitas'],
            'deskripsi' => $validatedData['deskripsi'],
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('rooms.table', ['role' => Auth::user()->role])
            ->with('success', 'Ruangan berhasil Diperbarui');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $ruangan = Ruangan::findOrFail($id);

        // Sarpras hanya bisa menghapus ruangan di gedung tertentu
        if ($user->role === 'sarpras' && !in_array($ruangan->gedung, ['GOR', 'FLTB', 'Anggrek', 'Auditorium'])) {
            return abort(403, 'Anda tidak memiliki izin menghapus ruangan ini.');
        }

        // BAAK hanya bisa menghapus ruangan di gedung Pendidikan
        if ($user->role === 'baak' && $ruangan->gedung !== 'Pendidikan') {
            return abort(403, 'Anda tidak memiliki izin menghapus ruangan ini.');
        }

        // Admin bisa menghapus semua ruangan tanpa batasan
        if ($user->role === 'admin' || $user->role === 'sarpras' || $user->role === 'baak') {
            $ruangan->delete();
            return redirect()->route('rooms.table', ['role' => $user->role])->with('success', 'Ruangan berhasil dihapus.');
        }

        return abort(403, 'Anda tidak memiliki izin menghapus ruangan ini.');
    }
}
