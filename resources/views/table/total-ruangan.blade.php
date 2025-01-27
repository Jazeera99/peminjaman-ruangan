<div class="container">
    <!-- Tombol Unduh -->
    <div class="d-flex justify-content-between mb-3">
        <div class="text-center">
            <a class="btn btn-primary text-white" href="/addruangan">Tambah Ruangan</a>
        </div>
        <div>
            <div class="container">
                <button id="showFormButton" class="btn btn-success mb-3">Buat Laporan</button>
                <div class="form-container" id="formContainer">
                    <button type="button" id="hideFormButton" class="close-button">&times;</button> 
                    <form action="" method="GET">
                        @csrf
                        <div class="row">
                            <!-- Dropdown Bulan -->
                            <div class="col-md-6 mb-3">
                                <label for="month" class="form-label">Pilih Bulan</label>
                                <select name="month" id="month" class="form-control" required>
                                    <option value="">-- Pilih Bulan --</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <!-- Tambahkan opsi bulan lainnya -->
                                </select>
                            </div>
        
                            <!-- Dropdown Tahun -->
                            <div class="col-md-6 mb-3">
                                <label for="year" class="form-label">Pilih Tahun</label>
                                <select name="year" id="year" class="form-control" required>
                                    <option value="">-- Pilih Tahun --</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <!-- Tambahkan opsi tahun lainnya -->
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-success me-2">Unduh Excel</button>
                            <button class="btn btn-danger">Unduh PDF</button>
                        </div>
                    </form>
                </div>
            </div>
        
            <script>
                document.getElementById('showFormButton').addEventListener('click', function() {
                    document.getElementById('formContainer').style.display = 'block';
                    this.style.display = 'none';
                });

                document.getElementById('hideFormButton').addEventListener('click', function() {
                    document.getElementById('formContainer').style.display = 'none';
                    document.getElementById('showFormButton').style.display = 'block';
                });
            </script>
        </div>
    </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabel -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-status">
            <thead class="table-primary text-center">
                <tr style="text-align: center; vertical-align: middle;">
                    <th>ROOM ID</th>
                    <th>GEDUNG</th>
                    <th>NAMA RUANGAN</th>
                    <th>KAPASITAS</th>
                    <th>DESKRIPSI</th>
                    <th>AKSI</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ruangans as $ruangan)
                    <tr>
                        <td>{{ $ruangan->id }}</td>
                        <td>{{ $ruangan->gedung }}</td>
                        <td>{{ $ruangan->nama }}</td>
                        <td>{{ $ruangan->kapasitas }}</td>
                        <td>{{ $ruangan->deskripsi ?? '-' }}</td>
                        <td class="text-center">
                            <!-- Tombol Edit -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editRuanganModal{{ $ruangans->id }}">EDIT</button>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('rooms.destroy', $ruangans->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?')">HAPUS</button>
                            </form>
                        </td>
                        <td>{{ $ruangan->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Data ruangan belum tersedia.</td>
                    </tr>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="editRuanganModal{{ $ruangans->id }}" tabindex="-1" aria-labelledby="editRuangansModalLabel{{ $ruangans->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editRuanganModalLabel{{ $ruangans->id }}">Edit Ruangan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('rooms.update', $ruangans->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
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
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select id="status" name="status" class="form-control" required>
                                                <option value="tersedia">Tersedia</option>
                                                <option value="tidak tersedia">Tidak Tersedia</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>                
                    <!-- End Modal Edit -->
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
