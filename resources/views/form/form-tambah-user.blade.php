@extends('layouts.main')

@section('content')
    <div class="row justify-content-center mt-1">
        <div class="col-md-4">
            <div class="card">
                <h4 class="card-header text-center">{{ __('FORM TAMBAH USER') }}</h4>
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="POST" id="formTambahUser">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_user" class="form-label">Nama User</label>
                            <input type="text" id="nama_user" name="nama_user" class="form-control"
                                placeholder="Masukkan nama user" required>
                            <div class="invalid-feedback">Nama user wajib diisi.</div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Masukkan email user" required>
                            <div class="invalid-feedback">Email wajib diisi.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Masukkan password user" minlength="8" required>
                            <div class="invalid-feedback">Password wajib diisi dan minimal 8 karakter.</div>
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
                            <div class="invalid-feedback">Role wajib dipilih.</div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Tambah User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript untuk validasi tambahan
        document.getElementById('formTambahUser').addEventListener('submit', function(event) {
            const form = this;
            if (!form.checkValidity()) {
                event.preventDefault(); // Mencegah pengiriman jika form tidak valid
                event.stopPropagation();
            }
            form.classList.add('was-validated'); // Tambahkan kelas untuk styling validasi
        });
    </script>
@endsection
