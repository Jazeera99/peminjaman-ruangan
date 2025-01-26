@extends('layouts.main')

@section('content')
    <!-- Form Update Ruangan -->
    <div class="row justify-content-center mt-1">
        <div class="col-md-4">
            <div class="card">
                <h4 class="card-header text-center">{{ __('FORM UPDATE RUANGAN') }}</h4>
                <div class="card-body">
                    <!-- Form Update Ruangan -->
                    <form action="{{ route('rooms.update', $ruangans->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Menggunakan method PUT untuk update -->

                        <div class="mb-3">
                            <label for="gedung" class="gedung">Gedung</label>
                            <select id="gedung" name="gedung" class="form-control" required>
                                <option value="">-- Pilih Gedung --</option>
                                @foreach (\App\Models\Ruangan::gedungOptions() as $value => $label)
                                    <option value="{{ $value }}" {{ $ruangans->gedung == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                            <input type="text" id="nama" name="nama" class="form-control"
                                value="{{ $ruangans->nama }}" placeholder="Masukkan nama ruangan" required>
                        </div>
                        <div class="mb-3">
                            <label for="kapasitas" class="form-label">Kapasitas</label>
                            <input type="number" id="kapasitas" name="kapasitas" class="form-control" 
                                   value="{{ $ruangans->kapasitas }}" placeholder="Masukkan kapasitas ruangan" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="deskripsi">Deskripsi</label>
                            <input type="text" id="deskripsi" name="deskripsi" class="form-control"
                                value="{{ $ruangans->deskripsi }}" placeholder="Masukkan deskripsi ruangan" required>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Update Ruangan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
