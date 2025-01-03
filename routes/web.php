<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/dashboard', function () {
//     return view('User.dashboard');
// })->name('dashboard');

// Route::get('/user/dashboard', function () {
//     // Data dummy untuk frontend
//     return view('user.dashboard', [
//         'booking_today' => 10, // Data dummy
//         'booking_lifetime' => 100 // Data dummy
//     ]);
// })->name('user.dashboard');

// // Debug route untuk memastikan `/user/dashboard` berjalan
// Route::get('/user/dashboard', function () {
//     dd('Route berhasil dipanggil!');
// });

// // Debug route untuk testing middleware kosong
// Route::get('/test-middleware', function () {
//     return "Middleware test route OK!";
// })->withoutMiddleware([\App\Http\Middleware\Authenticate::class]);

// // Route tes sederhana
// Route::get('/test', function () {
//     return "Route Test OK!";
// });

Route::get('/user/dashboard', function () {
    return view('user.dashboard', [
        'booking_today' => 10, // Data dummy
        'booking_lifetime' => 100 // Data dummy
    ]);
});

Route::get('/user/dashboard', function () {
    return view('user.dashboard');
});

Route::get('/user/dashboard', function () {
    // Data dummy untuk ditampilkan di view
    return view('user.dashboard', [
        'statistics' => [
            'pending' => 2,
            'rejected' => 0,
            'approved' => 1,
            'completed' => 1,
            'total' => 2
        ],
        'history' => [
            [
                'date' => '05/12/2024',
                'start_time' => '18:00',
                'end_time' => '19:30',
                'room' => 'R. 113',
                'borrower' => 'HIMATIF',
                'activity' => 'Rapat Himpunan',
                'status' => 'SELESAI'
            ],
            [
                'date' => '06/12/2024',
                'start_time' => '18:00',
                'end_time' => '19:30',
                'room' => 'R. 202',
                'borrower' => 'MPM',
                'activity' => 'Kegiatan Morris',
                'status' => 'DISETUJUI'
            ],
            [
                'date' => '11/12/2024',
                'start_time' => '18:00',
                'end_time' => '19:30',
                'room' => 'R. 202',
                'borrower' => 'HIPMI',
                'activity' => 'Kegiatan Kuliah',
                'status' => 'PROSES'
            ],
            [
                'date' => '13/12/2024',
                'start_time' => '18:00',
                'end_time' => '19:30',
                'room' => 'R. 202',
                'borrower' => 'Himatif',
                'activity' => 'Ospek Jurusan',
                'status' => 'PROSES'
            ],
        ]
    ]);
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/kalendar-reservasi', function () {
    return view('admin.kalendar-reservasi');
});

Route::get('/admin/list-booking', function () {
    return view('admin.list-booking');
});

Route::get('/user/profil', function () {
    return view('user.profil');
});

Route::get('/user/form-booking', function () {
    return view('user.form-booking');
});

Route::get('/admin/ruangan', function () {
    return view('admin.ruangan');
});

Route::get('/includes/content/tables/user-baak', function () {
    return view('includes.content.tables.user-baak');
});

Route::get('/includes/content/tables/user-sarpras', function () {
    return view('includes.content.tables.user-sarpras');
});

Route::get('/admin/user', function () {
    return view('admin.user');
});

Route::get('/baak/dashboard', function () {
    return view('baak.dashboard');
});

Route::get('/sarpras/dashboard', function () {
    return view('sarpras.dashboard');
});