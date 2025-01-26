<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Pastikan model User ada dan sesuai
use Illuminate\Support\Facades\Hash; // Untuk hashing password

class UserController extends Controller
{
    /**
     * Menampilkan form tambah user.
     */
    public function create() {}

    /**
     * Menyimpan user baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input form
        $validatedData = $request->validate([
            'nama_user' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email', // Pastikan email unik
            'password' => 'required|string|min:8', // Validasi panjang password minimal 8 karakter
            'role' => 'required|in:ormawa,ukm,sarpras,baak', // Validasi untuk role
        ]);

        // Menyimpan data ke dalam tabel users
        User::create([
            'nama' => $validatedData['nama_user'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Hash password sebelum disimpan
            'role' => $validatedData['role'],
        ]);

        // Redirect setelah menyimpan data
        return redirect()->back()->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Ambil data user berdasarkan ID
        return view('form.form-update-user', compact('user')); // Kirim data ke view update.blade.php
    }

    // Memproses pembaruan data user
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_user' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id, // Pastikan email unik kecuali miliknya sendiri
            'password' => 'nullable|string|min:8', // Password opsional
            'role' => 'required|in:ormawa,ukm,sarpras,baak', // Validasi role
        ]);

        $user = User::findOrFail($id); // Cari user berdasarkan ID

        // Update data user
        $user->nama = $validatedData['nama_user'];
        $user->email = $validatedData['email'];

        // Jika password diisi, hash password baru
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->role = $validatedData['role'];
        $user->save(); // Simpan perubahan

        // Redirect dengan pesan sukses
        return redirect()->route('user.table')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id); // Temukan data user
        $user->delete(); // Hapus data
        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }
}
