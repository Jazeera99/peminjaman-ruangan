<!-- Tabel -->
<div class="table-auto">
    <h4 style="text-align: center;">RIWAYAT EPEMINJAMAN</h4>
    <table class="table table-bordered table-hover table-status">
        <thead class="table-primary text-center">
            <tr style="text-align: center; vertical-align: middle;">
                <th>TANGGAL</th>
                <th>WAKTU MULAI</th>
                <th>WAKTU SELESAI</th>
                <th>RUANGAN</th>
                <th>PEMINJAM</th>
                <th>NAMA KEGIATAN</th>
                <th>NO WHATSAPP</th>
                <th>KETERANGAN</th>
                <th>PAS FOTO</th>
                <th>SURAT PERMOHONAN DAN SURAT DISPOSISI</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($peminjamanRuangans as $peminjaman)
                <tr>
                    <td>{{ $peminjaman->tanggal_kegiatan }}</td>
                    <td>{{ $peminjaman->waktu_mulai }}</td>
                    <td>{{ $peminjaman->waktu_selesai }}</td>
                    <td>{{ $peminjaman->room->nama ?? '-' }}</td>
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
            @endforeach --}}
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
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const statusSelects = document.querySelectorAll('.status-select');
        const reasonModal = new bootstrap.Modal(document.getElementById('reasonModal'));
        const peminjamanIdInput = document.getElementById('peminjamanId');
        const reasonForm = document.getElementById('reasonForm');

        statusSelects.forEach(select => {
            select.addEventListener('change', function () {
                const selectedValue = this.value;
                const peminjamanId = this.getAttribute('data-id');

                if (selectedValue === 'ditolak') {
                    // Set ID peminjaman di modal
                    peminjamanIdInput.value = peminjamanId;
                    // Tampilkan modal
                    reasonModal.show();
                }
            });
        });

    });
</script>

