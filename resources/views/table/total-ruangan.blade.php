<div class="container">
    <!-- Tombol Unduh -->
    <div class="d-flex justify-content-between mb-3">
        <div class="text-center">
            <a class="btn btn-primary text-white" href="/addruangan">Tambah Ruangan</a>
        </div>

        <div>
            <div class="container">
                <button id="showFormButton" class="btn btn-success mb-3">Buat Laporan</button>
                <div class="form-container" id="formContainer" style="display: none;">
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
                                    <option value="4">April</option>
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

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-bordered table-hover table-status">
        <thead class="table-primary text-center">
            <tr>
                <th>ID</th>
                <th>GEDUNG</th>
                <th>NAMA RUANGAN</th>
                <th>KAPASITAS</th>
                <th>DESKRIPSI</th>
                <th>STATUS</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ruangans as $ruangan)
                <tr>
                    <td>{{ $ruangan->id }}</td>
                    <td>{{ $ruangan->gedung }}</td>
                    <td>{{ $ruangan->nama }}</td>
                    <td>{{ $ruangan->kapasitas }}</td>
                    <td>{{ $ruangan->deskripsi }}</td>
                    <td>{{ ucfirst($ruangan->status) }}</td>
                    <td>
                        <!-- Tombol Edit -->
                        <button class="btn btn-primary btn-sm editButton" data-id="{{ $ruangan->id }}"
                            data-gedung="{{ $ruangan->gedung }}" data-nama="{{ $ruangan->nama }}"
                            data-kapasitas="{{ $ruangan->kapasitas }}" data-deskripsi="{{ $ruangan->deskripsi }}"
                            data-status="{{ $ruangan->status }}">
                            EDIT
                        </button>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('rooms.destroy', $ruangan->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?')">HAPUS
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Ruangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editRuanganForm" action="rooms.update">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="ruangan_id" name="id">

                        <div class="mb-3">
                            <label for="gedung" class="form-label">Gedung</label>
                            <select id="gedung" name="gedung" class="form-control">
                                <option value="FLTB">FLTB</option>
                                <option value="Pendidikan">Pendidikan</option>
                                <option value="Anggrek">Anggrek</option>
                                <option value="GOR">GOR</option>
                                <option value="Auditorium">Auditorium</option>
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

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-control">
                                <option value="tersedia">Tersedia</option>
                                <option value="tidak tersedia">Tidak Tersedia</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let editModal = new bootstrap.Modal(document.getElementById('editModal'));

            // Ketika tombol edit diklik, isi form dalam modal
            document.querySelectorAll('.editButton').forEach(button => {
                button.addEventListener('click', function() {
                    document.getElementById('ruangan_id').value = this.dataset.id;
                    document.getElementById('gedung').value = this.dataset.gedung;
                    document.getElementById('nama_ruangan').value = this.dataset.nama;
                    document.getElementById('kapasitas').value = this.dataset.kapasitas;
                    document.getElementById('deskripsi').value = this.dataset.deskripsi;
                    document.getElementById('status').value = this.dataset.status;
                    editModal.show();
                });
            });

            // Form submit dengan AJAX
            document.getElementById('editRuanganForm').addEventListener('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let id = document.getElementById('ruangan_id').value;

                fetch(`/ruangan/update/${id}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Ruangan berhasil diperbarui!');
                            editModal.hide();
                            setTimeout(() => {
                                location.reload();
                            }, 500);
                        } else {
                            alert('Gagal memperbarui ruangan.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
