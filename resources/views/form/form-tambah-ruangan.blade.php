@extends('layouts.main')

@section('content')
    <!-- Form Tambah Ruangan -->
    <div class="row justify-content-center mt-1">
        <div class="col-md-5">
            <div class="card">
                <h4 class="card-header text-center">{{ __('FORM TAMBAH RUANGAN') }}</h4>
                <div class="card-body">
                    <!-- Form Tambah Ruangan -->
                    <form action="{{ route('rooms.store') }}" method="POST">
                        @csrf
                        <div class="col-md-6">
                            <label for="gedung" class="gedung">Gedung</label>
                            <select id="gedung" name="gedung" class="form-control" required>
                                <option value="">-- Pilih Gedung --</option>
                                @foreach (\App\Models\Ruangan::gedungOptions() as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
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
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Tambah Ruangan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
