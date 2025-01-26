@extends('layouts.main')

@section('content')
    <div class="row justify-content-center mt-1">
        <div class="col-md-4">
            <div class="card">
                <h4 class="card-header text-center">{{ __('FORM UPDATE USER') }}</h4>
                <div class="card-body">
                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama_user" class="form-label">Nama User</label>
                            <input type="text" id="nama_user" name="nama_user" class="form-control"
                                value="{{ $user->nama }}" placeholder="Masukkan nama user" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ $user->email }}" placeholder="Masukkan email user" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password (kosongkan jika tidak ingin diubah)</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Masukkan password baru">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="role">Role</label>
                            <select id="role" name="role" class="form-control" required>
                                <option value="">-- Pilih role --</option>
                                <option value="ormawa" {{ $user->role == 'ormawa' ? 'selected' : '' }}>Ormawa</option>
                                <option value="ukm" {{ $user->role == 'ukm' ? 'selected' : '' }}>Ukm</option>
                                <option value="baak" {{ $user->role == 'baak' ? 'selected' : '' }}>BAAK</option>
                                <option value="sarpras" {{ $user->role == 'sarpras' ? 'selected' : '' }}>Sarpras</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
