@extends('layouts.main')

@section('content')
    @php
        $userRole = Auth::user()->role;
    @endphp

    <div class="row justify-content-center mt-1">
        <div class="col-md-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div class="text-center mb-3">
                    <a href="{{ route('rooms.table', ['role' => $userRole]) }}" class="btn btn-success">Kembali</a>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div class="text-center mb-3">
                    <a href="{{ route('rooms.table', ['role' => $userRole]) }}" class="btn btn-success">Kembali</a>
                </div>
            @endif

            <div class="card">
                <h4 class="card-header text-center">{{ __('FORM TAMBAH RUANGAN') }}</h4>
                <div class="card-body">
                    <form action="{{ route('rooms.store') }}" method="POST" id="formTambahRuangan">
                        @csrf
                        <div class="mb-3">
                            <label for="gedung" class="form-label">Gedung</label>
                            <select id="gedung" name="gedung" class="form-control" required>
                                <option value="">-- Pilih Gedung --</option>
                                @if ($userRole === 'sarpras')
                                    <option value="FLTB">FLTB</option>
                                    <option value="Anggrek">Anggrek</option>
                                    <option value="GOR">GOR</option>
                                    <option value="Auditorium">Auditorium</option>
                                @elseif ($userRole === 'baak')
                                    <option value="Pendidikan">Pendidikan</option>
                                @else
                                    <option value="FLTB">FLTB</option>
                                    <option value="Pendidikan">Pendidikan</option>
                                    <option value="Anggrek">Anggrek</option>
                                    <option value="GOR">GOR</option>
                                    <option value="Auditorium">Auditorium</option>
                                @endif
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                            <input type="text" id="nama_ruangan" name="nama_ruangan" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="kapasitas" class="form-label">Kapasitas</label>
                            <input type="number" id="kapasitas" name="kapasitas" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" class="form-control"></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Tambah Ruangan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('formTambahRuangan').addEventListener('submit', function(event) {
            const form = this;
            if (!form.checkValidity()) {
                event.preventDefault(); 
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    </script>
@endsection
