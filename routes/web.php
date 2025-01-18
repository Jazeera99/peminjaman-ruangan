<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RuanganController;
use App\Models\Ruangan;

// Menampilkan form login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Menangani login dengan metode POST
Route::post('/login', [AuthController::class, 'login'])->name('login.custom');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Menampilkan list booking berdasarkan role
Route::get('/{role}/list-booking', [PeminjamanController::class, 'index'])->name('booking.status');
Route::get('/dashboard/admin', [DashboardController::class, 'adminDashboard']);
Route::get('/dashboard/peminjam', [DashboardController::class, 'PeminjamDashboard']);
Route::get('/{role}/kalendar-reservasi', [DashboardController::class, 'KalendarReservasi'])->name('kalendar.reservasi');
Route::get('/user/profil', [DashboardController::class, 'userProfil']);
Route::get('/dashboard/booking', [DashboardController::class, 'FormBooking'])->name('booking');
Route::get('/admin/ruangan', [DashboardController::class, 'formTambahRuangan']);
Route::get('/user/table/user-baak', [DashboardController::class, 'tableUserBaak']);
Route::get('/user/table/user-sarpras', [DashboardController::class, 'tableUserSarpras']);
Route::get('/admin/user', [DashboardController::class, 'adminUser']);
Route::get('/dashboard/baak', [DashboardController::class, 'dashboardBaak']);
Route::get('/dashboard/sarpras', [DashboardController::class, 'dashboardSarpras']);
Route::post('/submit-booking', [BookingController::class, 'store']);
Route::post('/add/ruangan', [RuanganController::class, 'store'])->name('rooms.store');