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
Route::get('/admin/ruangan', [DashboardController::class, 'showlistruangan']);
Route::get('/addruangan', [DashboardController::class, 'ShowFormRuangan']);
Route::get('/dashboard/booking', [DashboardController::class, 'ShowFormBooking'])->name('booking');
Route::get('/user/table/user-baak', [DashboardController::class, 'tableUserBaak']);
Route::get('/user/table/user-sarpras', [DashboardController::class, 'tableUserSarpras']);
Route::get('/admin/user', [DashboardController::class, 'showlistuser']);
Route::post('/submit-booking', [BookingController::class, 'store']);
Route::post('/add/ruangan', [RuanganController::class, 'store'])->name('rooms.store');
Route::post('/add/user', [UserController::class, 'store'])->name('user.store');
Route::get('/list/data-user', [DashboardController::class, 'TableUser']);
Route::get('/adduser', [DashboardController::class, 'ShowFormUser']);
