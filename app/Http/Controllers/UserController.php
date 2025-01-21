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
}
