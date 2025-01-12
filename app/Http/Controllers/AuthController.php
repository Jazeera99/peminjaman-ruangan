<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login')->with('title', 'Login');
    }

    // Menangani login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Coba login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Ambil role pengguna
            $role = Auth::user()->role;

            // Arahkan pengguna berdasarkan role
            switch ($role) {
                case 'admin';
                    return redirect()->intended('/dashboard/admin');
                case 'ormawa':
                case 'ukm':
                    return redirect()->intended('/dashboard/peminjam');
                case 'baak':
                    return redirect()->intended('/dashboard/baak');
                case 'sarpras':
                    return redirect()->intended('/dashboard/sarpras');
            }
        }

        // Login gagal
        return back()->withErrors([
            'email' => __('Email atau Password salah.'),
        ])->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna
        return redirect('/'); // Redirect ke halaman login
    }
}
