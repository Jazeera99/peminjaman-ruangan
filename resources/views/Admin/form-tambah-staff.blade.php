@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <H4><div class="card-header text-center">{{ __('FORM PEMINJAMAN RUANGAN') }}</div></H4>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                    
                        <!-- Tanggal -->
                        <div class="form-group >
                            <label for="tanggalPembuatan">Tanggal Pembuatan</label>
                            <input type="date" id="tanggalPembuatan" name="tanggalPembuatan" class="form-control" readonly>
                        </div>

                        <!-- NIP -->
                        <div class="d-flex justify-content-between mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="date" id="nip" name="nip" class="form-control" required>
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-md-12">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama" required>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-md-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
                            </div>
                        </div>

                        <!-- Pilih Role -->
                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-md-12">
                                <label for="role" class="form-label">Role</label>
                                <select id="role" name="role" class="form-select" required>
                                    <option value="" disabled selected>Pilih Role</option>
                                    <option value="baak">BAAK</option>
                                    <option value="sarpras">Sarpras</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tanggalInput = document.getElementById('tanggal');
    });
</script>
@endsection
