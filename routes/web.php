<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\UserController;

// Menampilkan halaman utama
Route::get('/', function () {
    return view('home');
});
// Menampilkan form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Menangani login dengan metode POST
Route::post('/login', [AuthController::class, 'login'])->name('login.custom');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard berdasarkan role
Route::get('/dashboard/{role}', [DashboardController::class, 'dashboard'])
    ->where('role', 'peminjam|admin|baak|sarpras');

// Menampilkan list booking berdasarkan role
Route::get('/{role}/list-booking', [PeminjamanController::class, 'index'])->name('booking.status');
Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');

// Download laporan dalam format Excel atau PDF
Route::get('/download/excel', [PeminjamanController::class, 'downloadExcel'])->name('download.excel');
Route::get('/download/pdf', [PeminjamanController::class, 'downloadPdf'])->name('download.pdf');

// Kalender reservasi berdasarkan role
Route::get('/{role}/kalendar-reservasi', [DashboardController::class, 'KalendarReservasi'])->name('kalendar.reservasi');
Route::get('/get-events', [PeminjamanController::class, 'getEvents']);
Route::get('/get-events-by-date', [PeminjamanController::class, 'getEventsByDate']);

// Manajemen Ruangan
Route::get('{role}/ruangan', [RuanganController::class, 'showlistruangan'])->name('rooms.table');
Route::get('/addruangan', [RuanganController::class, 'ShowFormRuangan']);
Route::post('/add/ruangan', [RuanganController::class, 'store'])->name('rooms.store');
Route::put('/rooms/{id}', [RuanganController::class, 'update'])->name('rooms.update');
Route::delete('/rooms/{id}', [RuanganController::class, 'destroy'])->name('rooms.destroy');

// Manajemen Booking
Route::get('/dashboard/booking', [DashboardController::class, 'ShowFormBooking'])->name('booking');
Route::post('/submit-booking', [BookingController::class, 'store']);
Route::put('/peminjaman/status/{id}', [PeminjamanController::class, 'updateStatus'])->name('peminjaman.status');


// Manajemen User
Route::get('/user/table/user-baak', [DashboardController::class, 'tableUserBaak']);
Route::get('/user/table/user-sarpras', [DashboardController::class, 'tableUserSarpras']);
Route::get('/admin/user', [DashboardController::class, 'showlistuser'])->name('user.table');
Route::get('/adduser', [DashboardController::class, 'ShowFormUser']);
Route::post('/add/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
