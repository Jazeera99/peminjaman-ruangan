@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <H4><div class="card-header text-center">{{ __('Biodata Diri') }}</div></H4>
                <div class="card-body">
                    @csrf
                    <!-- Pas Foto -->
                    <div class="row mb-3 justify-content-center">
                        <img src="../assets/images/profile.png" alt="profile">
                    </div>

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
                            <input id="prodi" type="text" class="form-control @error('prodi') is-invalid @enderror" name="prodi" value="{{ old('prodi') }}" required>
                            @error('prodi')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                
                    <!-- Semester -->
                    <div class="row mb-3">
                        <label for="semester" class="col-md-4 col-form-label text-md-end">{{ __('Semester') }}</label>
                        <div class="col-md-6">
                            <input id="semester" type="text" class="form-control @error('semester') is-invalid @enderror" name="semester" value="{{ old('semester') }}" required>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection