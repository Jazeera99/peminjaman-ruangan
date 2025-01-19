<?php

namespace App\Http\Controllers;

use App\Models\ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input form
        $validatedData = $request->validate([
            'gedung' => 'required|in:FLTB,Pendidikan,Anggrek,GOR,Auditorium',
            'nama_ruangan' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        // Menyimpan data ke dalam tabel ruangan
        Ruangan::create([
            'gedung' => $validatedData['gedung'],
            'nama' => $validatedData['nama_ruangan'],
            'kapasitas' => $validatedData['kapasitas'],
            'deskripsi' => $validatedData['deskripsi'],
        ]);

        // Redirect setelah menyimpan data
        return redirect()->back()->with('success', 'Ruangan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(ruangan $ruangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ruangan $ruangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ruangan $ruangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ruangan $ruangan)
    {
        //
    }
}
