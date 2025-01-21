@extends('layouts.main')

@section('content')
<div class="row justify-content-center mt-1"> 
    <div class="col-md-4"> 
        <div class="card"> 
            <h4 class="card-header text-center">{{ __('FORM TAMBAH USER') }}</h4> 
            <div class="card-body"> 
                <form action="{{ route('user.store') }}" method="POST"> 
                    @csrf 
                    <div class="mb-3"> 
                        <label for="nama_user" class="form-label">Nama User</label> 
                        <input type="text" id="nama_user" name="nama_user" class="form-control" placeholder="Masukkan nama user" required> 
                    </div> 
                    <div class="mb-3"> 
                        <label for="email" class="form-label">Email</label> 
                        <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email user" required> 
                    </div>
                    <div class="mb-3"> 
                        <label for="password" class="form-label">Password</label> 
                        <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password user" required> 
                    </div>
                    <div class="mb-3">
                        <label for="role" class="role">Role</label>
                        <select id="role" name="role" class="form-control" required>
                            <option value="">-- Pilih role --</option>
                            <option value="ormawa">Ormawa</option>
                            <option value="ukm">Ukm</option>
                            <option value="baak">BAAK</option>
                            <option value="sarpras">Sarpras</option>
                        </select>
                    </div>
                    <div class="text-center mt-3"> 
                        <button type="submit" class="btn btn-primary">Tambah User</button> 
                    </div> 
                </form> 
            </div>
        </div> 
    </div>
</div>
@endsection
