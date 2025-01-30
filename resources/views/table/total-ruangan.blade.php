<div class="container">
    <!-- Tombol Unduh -->
    <div class="d-flex justify-content-between mb-3">
        <div class="text-center">
            <a class="btn btn-primary text-white" href="/addruangan">Tambah Ruangan</a>
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
                                data-bs-target="#editRuanganModal{{ $ruangan->id }}">EDIT</button>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('rooms.destroy', $ruangan->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?')">HAPUS</button>
                            </form>
                        </td>
                        <td>{{ $ruangan->status }}</td>
                    </tr>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="editRuanganModal{{ $ruangan->id }}" tabindex="-1"
                        aria-labelledby="editRuangansModalLabel{{ $ruangan->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editRuanganModalLabel{{ $ruangan->id }}">Edit Ruangan
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('rooms.update', $ruangan->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="gedung" class="gedung">Gedung</label>
                                            <select id="gedung" name="gedung" class="form-control" required>
                                                <option value="">-- Pilih Gedung --</option>
                                                @foreach (\App\Models\Ruangan::gedungOptions() as $value => $label)
                                                    <option value="{{ $value }}"
                                                        {{ $ruangan->gedung == $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                                            <input type="text" id="nama_ruangan" name="nama_ruangan"
                                                class="form-control" value="{{ $ruangan->nama }}"
                                                placeholder="Masukkan nama ruangan" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kapasitas" class="form-label">Kapasitas</label>
                                            <input type="number" id="kapasitas" name="kapasitas" class="form-control"
                                                value="{{ $ruangan->kapasitas }}"
                                                placeholder="Masukkan kapasitas ruangan" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="deskripsi">Deskripsi</label>
                                            <input type="text" id="deskripsi" name="deskripsi" class="form-control"
                                                value="{{ $ruangan->deskripsi }}"
                                                placeholder="Masukkan deskripsi ruangan" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select id="status" name="status" class="form-control" required>
                                                <option value="tersedia"
                                                    {{ $ruangan->status == 'tersedia' ? 'selected' : '' }}>Tersedia
                                                </option>
                                                <option value="tidak tersedia"
                                                    {{ $ruangan->status == 'tidak tersedia' ? 'selected' : '' }}>Tidak
                                                    Tersedia</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Data ruangan belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
