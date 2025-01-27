@extends('layouts.main')

@section('content')
    <!-- Form Tambah Ruangan -->
    <div class="row justify-content-center mt-1">
        <div class="col-md-4">
            @if (session('success'))
                <!-- Pesan Sukses -->
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <!-- Tombol Kembali ke Halaman Manage Ruangan -->
                <div class="text-center mb-3">
                    <a href="{{ route('rooms.table') }}" class="btn btn-success">Kembali</a>
                </div>
            @endif
            <div class="card">
                <h4 class="card-header text-center">{{ __('FORM TAMBAH RUANGAN') }}</h4>
                <div class="card-body">
                    <!-- Form Tambah Ruangan -->
                    <form action="{{ route('rooms.store') }}" method="POST" id="formTambahRuangan">
                        @csrf
                        <div class="mb-3">
                            <label for="gedung" class="gedung">Gedung</label>
                            <select id="gedung" name="gedung" class="form-control" required>
                                <option value="">-- Pilih Gedung --</option>
                                @foreach (\App\Models\Ruangan::gedungOptions() as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                            <input type="text" id="nama_ruangan" name="nama_ruangan" class="form-control"
                                placeholder="Masukkan nama ruangan" required>
                        </div>
                        <div class="mb-3">
                            <label for="kapasitas" class="form-label">Kapasitas</label>
                            <input type="number" id="kapasitas" name="kapasitas" class="form-control" 
                                   placeholder="Masukkan kapasitas ruangan" required>
                        </div>                        
                        <div class="mb-3">
                            <label for="deskripsi" class="deskripsi">Deskripsi</label>
                            <input type="text" id="deskripsi" name="deskripsi" class="form-control"
                                placeholder="Masukkan deskripsi ruangan" required>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Tambah Ruangan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        // JavaScript untuk validasi tambahan
        document.getElementById('formTambahRuangan').addEventListener('submit', function(event) {
            const form = this;
            if (!form.checkValidity()) {
                event.preventDefault(); // Mencegah pengiriman jika form tidak valid
                event.stopPropagation();
            }
            form.classList.add('was-validated'); // Tambahkan kelas untuk styling validasi
        });
    </script>
@endsection
