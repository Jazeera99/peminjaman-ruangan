@extends('layouts.main')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">

    <!-- Baris Total User dan Total Ruangan -->
    <div class="row mb-4">
        <!-- Kotak Total User -->
        <div class="col-md-6">
            <div class="card shadow-sm p-4 h-100">
                <h2 class="text-center mb-4">TOTAL USER</h2>
                <div class="d-flex flex-column">
                    <div class="d-flex justify-content-between w-100 sm-5">
                        @include('statistik.user.baak')
                        @include('statistik.user.sarpras')
                    </div>
                    <div class="d-flex justify-content-between w-100 md-3 mt-3">
                        @include('statistik.user.pengguna')
                    </div>
                </div>
            </div>
        </div>

        <!-- Kotak Total Ruangan -->
        <div class="col-md-6">
            <div class="card shadow-sm p-4 h-100">
                <h2 class="text-center mb-4">TOTAL RUANGAN</h2>
                <div class="d-flex flex-column">
                    <div class="d-flex justify-content-between w-100 mb-3">
                        @include('statistik.ruangan.vokasi')
                        @include('statistik.ruangan.fltb')
                    </div>
                    <div class="d-flex justify-content-between w-100">
                        @include('statistik.ruangan.sarpras')
                        @include('statistik.ruangan.anggrek')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kotak Statistik Booking -->
    <div class="d-flex flex-column align-items-center">
        <div class="col-6">
            <div class="card shadow-sm p-4">
                @include('statistik.statistik-booking')
            </div>
        </div>
    </div>
</div>
@endsection
