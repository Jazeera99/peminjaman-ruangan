@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <!-- Hero Section -->
    <section class=" text-black py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Sistem Peminjaman Ruangan</h1>
                    <p class="lead mb-4">Selamat datang di sistem peminjaman ruangan. Kelola dan atur peminjaman ruangan dengan mudah dan efisien.</p>
                    <a href="/login" class="btn btn-dark btn-lg px-4">Mulai Sekarang</a>
                </div>
                <div class="col-lg-6">
                    <img src="../images/logo-black-roomease.png" alt="roomease Image" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features py-5">
        <div class="container">
            <h2 class="text-center mb-5">Fitur Unggulan</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-calendar-check fs-1 text-primary mb-3"></i>
                            <h5 class="card-title">Peminjaman Online</h5>
                            <p class="card-text">Ajukan peminjaman ruangan secara online dengan mudah dan cepat</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-clock-history fs-1 text-primary mb-3"></i>
                            <h5 class="card-title">Tracking Status</h5>
                            <p class="card-text">Pantau status peminjaman ruangan secara real-time</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-building fs-1 text-primary mb-3"></i>
                            <h5 class="card-title">Manajemen Ruangan</h5>
                            <p class="card-text">Kelola ketersediaan ruangan dengan sistem yang terintegrasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats bg-light py-5">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="stat-card p-3">
                        <h3 class="display-4 fw-bold text-primary">{{ $stats['total_ruangan'] }}</h3>
                        <p class="text-muted">Total Ruangan</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card p-3">
                        <h3 class="display-4 fw-bold text-primary">{{ $stats['ruangan_tersedia'] }}</h3>
                        <p class="text-muted">Ruangan Tersedia</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card p-3">
                        <h3 class="display-4 fw-bold text-primary">{{ $stats['peminjaman_hari_ini'] }}</h3>
                        <p class="text-muted">Peminjaman Hari Ini</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Available Rooms Section -->
    <section class="available-rooms py-5">
        <div class="container">
            <h2 class="text-center mb-4">Ruangan Tersedia Hari Ini</h2>
            <div class="row g-4">
                @if($available_rooms->count() > 0)
                    @foreach($available_rooms as $room)
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $room->nama }}</h5>
                                    <p class="card-text">
                                        <i class="bi bi-building"></i> <strong>Gedung:</strong> {{ $room->gedung }}<br>
                                        <i class="bi bi-people"></i> <strong>Kapasitas:</strong> {{ $room->kapasitas }} orang<br>
                                        <i class="bi bi-check-circle text-success"></i> <strong>Status:</strong> Tersedia
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p class="text-muted">Semua ruangan telah dibooking untuk hari ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>

<style>
.features .card {
    transition: transform 0.3s ease;
}

.features .card:hover {
    transform: translateY(-5px);
}

.stat-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.bi {    line-height: 1;
}
</style>
@endsection
