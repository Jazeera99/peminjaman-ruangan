<div class="container mt-4">
    <!-- Tombol Unduh -->
    <div class="d-flex justify-content-between mb-3">
        <div class="text-center">
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

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <!-- Tabel -->
    <div class="table-auto">
        <table class="table table-bordered table-hover table-status">
            <thead class="table-primary text-center">
                <tr style="text-align: center; vertical-align: middle;">
                    <th>ID</th>
                    <th>TANGGAL</th>
                    <th>WAKTU MULAI</th>
                    <th>WAKTU SELESAI</th>
                    <th>RUANGAN</th>
                    <th>PEMINJAM</th>
                    <th>ORGANISASI</th>
                    <th>NAMA KEGIATAN</th>
                    <th>NO WHATSAPP</th>
                    <th>KETERANGAN</th>
                    <th>PAS FOTO</th>
                    <th>SURAT PERMOHONAN DAN SURAT DISPOSISI</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjamanRuangans as $peminjaman)
                    <tr>
                        <td>{{ $peminjaman->id }}</td>
                        <td>{{ $peminjaman->tanggal_kegiatan}}</td>
                        <td>{{ $peminjaman->waktu_mulai }}</td>
                        <td>{{ $peminjaman->waktu_selesai }}</td>
                        <td>{{ $peminjaman->room->nama ?? '-' }}</td>
                        <td>{{ $peminjaman->nama_peminjam }}</td>
                        <td>{{ $peminjaman->user->nama ?? '-' }}</td>
                        <td>{{ $peminjaman->nama_kegiatan }}</td>
                        <td>{{ $peminjaman->nomor_Whatsapp }}</td>
                        <td>{{ $peminjaman->keterangan }}</td>
                        <td>{{ $peminjaman->pas_foto }}</td>
                        <td>{{ $peminjaman->file_tambahan }}</td> 
                        <td class="text-center">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" name="status" class="form-control" required>
                                    <option value="disetujui">DISETUJUI</option>
                                    <option value="ditolak">DITOLAK</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal Alasan Penolakan -->
    <div class="modal fade" id="reasonModal" tabindex="-1" aria-labelledby="reasonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reasonModalLabel">Alasan Penolakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="reasonForm">
                        @csrf
                        <input type="hidden" id="peminjamanId" name="peminjaman_id">
                        <div class="mb-3">
                            <label for="reason" class="form-label">Alasan</label>
                            <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
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

        document.querySelectorAll('.status-select').forEach(function(select) {
            select.addEventListener('change', function() {
                if (this.value === 'ditolak') {
                    document.getElementById('peminjamanId').value = this.getAttribute('data-id');
                    var reasonModal = new bootstrap.Modal(document.getElementById('reasonModal'));
                    reasonModal.show();
                }
            });
        });

        document.getElementById('reasonForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var peminjamanId = document.getElementById('peminjamanId').value;
            var reason = document.getElementById('reason').value;
            fetch('/peminjaman/' + peminjamanId + '/reject', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    reason: reason
                })
            })
            "]').getAttribute('content')
                },
                body: JSON.stringify({
                    peminjaman_id: peminjamanId,
                    reason: reason
                })
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    var reasonModal = bootstrap.Modal.getInstance(document.getElementById('reasonModal'));
                    reasonModal.hide();
                    alert('Alasan penolakan berhasil dikirim');
                } else {
                    alert('Gagal mengirim alasan penolakan');
                }
            }).catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            });
        });
    </script>
</div>
