<!-- Tabel -->
<div class="table-responsive">
    <h4 style="text-align: center;">RIWAYAT PEMINJAMAN</h4>
    <table class="table table-bordered table-hover table-status">
        <thead class="table-primary text-center">
            <tr>
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
                <th>SURAT PERMOHONAN</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjamanRuangans as $peminjaman)
                <tr>
                    <td>{{ $peminjaman->id }}</td>
                    <td>{{ $peminjaman->tanggal_kegiatan }}</td>
                    <td>{{ $peminjaman->waktu_mulai }}</td>
                    <td>{{ $peminjaman->waktu_selesai }}</td>
                    <td>{{ $peminjaman->room->nama ?? '-' }}</td>
                    <td>{{ $peminjaman->nama_peminjam }}</td>
                    <td>{{ $peminjaman->user->nama ?? '-' }}</td>
                    <td>{{ $peminjaman->nama_kegiatan }}</td>
                    <td>{{ $peminjaman->nomor_Whatsapp }}</td>
                    <td>{{ $peminjaman->keterangan }}</td>
                    <td>
                        @if ($peminjaman->pas_foto)
                            <img src="{{ asset('storage/' . $peminjaman->pas_foto) }}" alt="Pas Foto" width="100">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($peminjaman->file)
                            @php
                                $fileExtension = pathinfo($peminjaman->file, PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                <!-- Jika file adalah gambar, tampilkan sebagai img -->
                                <img src="{{ asset('storage/' . $peminjaman->file) }}" alt="Surat Permohonan"
                                    width="50">
                            @elseif ($fileExtension == 'pdf')
                                <!-- Jika file adalah PDF, tampilkan dalam iframe -->
                                <iframe src="{{ asset('storage/' . $peminjaman->file) }}" width="100"
                                    height="100"></iframe>
                            @else
                                <!-- Jika file format lain, tampilkan link download -->
                                <a href="{{ asset('storage/' . $peminjaman->file) }}" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    Lihat File
                                </a>
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-center">
                        {{ $peminjaman->status }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">Tidak ada riwayat peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="reasonModal" tabindex="-1" aria-labelledby="reasonModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="reasonForm" action="/peminjaman/tolak" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="reasonModalLabel">Alasan Penolakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="peminjamanId" name="peminjaman_id">
                    <div class="mb-3">
                        <label for="reason" class="form-label">Alasan</label>
                        <textarea id="reason" name="reason" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const statusSelects = document.querySelectorAll('.status-select');
        const reasonModal = new bootstrap.Modal(document.getElementById('reasonModal'));
        const peminjamanIdInput = document.getElementById('peminjamanId');

        statusSelects.forEach(select => {
            select.addEventListener('change', function() {
                const selectedValue = this.value;
                const peminjamanId = this.getAttribute('data-id');

                if (selectedValue === 'ditolak') {
                    // Set ID peminjaman di modal
                    peminjamanIdInput.value = peminjamanId;
                    // Tampilkan modal
                    reasonModal.show();
                } else {
                    // Simpan status langsung jika bukan "ditolak"
                    fetch(`/peminjaman/update-status/${peminjamanId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                status: selectedValue
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Status berhasil diperbarui!');
                            } else {
                                alert('Gagal memperbarui status.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    });
</script>
