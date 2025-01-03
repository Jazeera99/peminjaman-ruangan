@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- NPM -->
                        <div class="row mb-3">
                            <label for="npm" class="col-md-4 col-form-label text-md-end">{{ __('NPM') }}</label>
                            <div class="col-md-6">
                                <input id="npm" type="text" class="form-control @error('npm') is-invalid @enderror" name="npm" value="{{ old('npm') }}" required>
                                @error('npm')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Program Studi -->
                        <div class="row mb-3">
                            <label for="prodi" class="col-md-4 col-form-label text-md-end">{{ __('Program Studi') }}</label>
                            <div class="col-md-6">
                                <select id="prodi" name="prodi" class="form-select @error('prodi') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Program Studi</option>
                                    <option value="Teknik Informatika">D3 Teknik Informatika</option>
                                    <option value="Manajemen Informatika">D3 Manajemen Informatika</option>
                                    <option value="Akuntansi">D3 Akuntansi</option>
                                    <option value="Administrasi Logistik">D3 Administrasi Logistik</option>
                                    <option value="Manajemen Pemasaran">D3 Manajemen Pemasaran</option>
                                    <option value="Teknik Informatika">D4 Teknik Informatika</option>
                                        <option value="Teknik Informatika">D4 Manajemen Perusahaan</option>
                                        <option value="Teknik Informatika">D4 Akuntansi Keuangan</option>
                                        <option value="Teknik Informatika">D4 Logistik Bisnis</option>
                                        <option value="Teknik Informatika">D4 Logistik Niaga-EL</option>
                                        <option value="Teknik Informatika">S1 Manajemen Logistik</option>
                                        <option value="Teknik Informatika">S1 Manajemen Transportasi</option>
                                        <option value="Teknik Informatika">S1 Manajemen Rekayasa</option>
                                        <option value="Teknik Informatika">S1 Bisnis Digital</option>
                                        <option value="Teknik Informatika">S1 Sains Data</option>
                                        <option value="Teknik Informatika">S2 Manajemen Logistik</option>
                                </select>
                                @error('prodi')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Semester -->
                        <div class="row mb-3">
                            <label for="semester" class="col-md-4 col-form-label text-md-end">{{ __('Semester') }}</label>
                            <div class="col-md-6">
                                <select id="semester" name="semester" class="form-select @error('semester') is-invalid @enderror" required>
                                    <option value="" disabled selected>Pilih Semester</option>
                                    @for($i = 1; $i <= 8; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('semester')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="row mb-3">
                            <label for="no_telp" class="col-md-4 col-form-label text-md-end">{{ __('Nomor Telepon') }}</label>
                            <div class="col-md-6">
                                <input id="no_telp" type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp') }}" required>
                                @error('no_telp')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <!-- Pas Foto -->
                        <div class="row mb-3">
                            <label for="foto" class="col-md-4 col-form-label text-md-end">{{ __('Pas Foto') }}</label>
                            <div class="col-md-6">
                                <input id="foto" type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" accept="image/*" required>
                                @error('foto')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Register -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
