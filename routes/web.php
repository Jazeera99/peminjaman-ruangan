<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\UserController;
use App\Models\Ruangan;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Menampilkan form login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Menangani login dengan metode POST
Route::post('/login', [AuthController::class, 'login'])->name('login.custom');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard/{role}', [DashboardController::class, 'dashboard'])
    ->where('role', 'peminjam|admin|baak|sarpras'); // Validasi parameter
// Menampilkan list booking berdasarkan role
Route::get('/{role}/list-booking', [PeminjamanController::class, 'index'])->name('booking.status');
Route::get('/{role}/kalendar-reservasi', [DashboardController::class, 'KalendarReservasi'])->name('kalendar.reservasi');
Route::get('/admin/ruangan', [DashboardController::class, 'showlistruangan'])->name('rooms.table');
Route::get('/addruangan', [DashboardController::class, 'ShowFormRuangan']);
Route::get('/dashboard/booking', [DashboardController::class, 'ShowFormBooking'])->name('booking');
Route::get('/user/table/user-baak', [DashboardController::class, 'tableUserBaak']);
Route::get('/user/table/user-sarpras', [DashboardController::class, 'tableUserSarpras']);
Route::get('/admin/user', [DashboardController::class, 'showlistuser'])->name('user.table');
Route::post('/submit-booking', [BookingController::class, 'store']);
Route::post('/add/ruangan', [RuanganController::class, 'store'])->name('rooms.store');
Route::post('/add/user', [UserController::class, 'store'])->name('user.store');
Route::get('/adduser', [DashboardController::class, 'ShowFormUser']);
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit'); // Form update user
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update'); // Proses update user
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('/rooms/{id}/edit', [RuanganController::class, 'edit'])->name('rooms.edit');
Route::put('/rooms/{id}', [RuanganController::class, 'update'])->name('rooms.update');
Route::delete('/rooms/{id}', [RuanganController::class, 'destroy'])->name('rooms.destroy');
