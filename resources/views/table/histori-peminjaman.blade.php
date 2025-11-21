<!-- Tabel Riwayat Peminjaman -->
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
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjamanRuangans as $peminjaman)
                <tr>
                    <td>{{ $peminjaman->id }}</td>
                    <td>{{ $peminjaman->tanggal_kegiatan }}</td>
                    <td>{{ \Carbon\Carbon::parse($peminjaman->waktu_mulai)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($peminjaman->waktu_selesai)->format('H:i') }}</td>
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
                                <img src="{{ asset('storage/' . $peminjaman->file) }}" alt="Surat Permohonan" width="50">
                            @else
                                <!-- Jika file format lain, tampilkan link download -->
                                <a href="{{ asset('storage/' . $peminjaman->file) }}" target="_blank" class="btn btn-primary btn-sm">Lihat File</a>
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-center">
                        {{ $peminjaman->status }}
                        @if ($peminjaman->status === 'disetujui' && $peminjaman->alasan_disetujui)
                        @endif
                    </td>
                    <td>
                        @if ($peminjaman->status === 'PENDING')
                            <form action="{{ route('peminjaman.cancel', $peminjaman->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-warning btn-sm">Batalkan</button>
                            </form>
                        @elseif ($peminjaman->status === 'disetujui' && $peminjaman->alasan_disetujui)
                            <!-- Tampilkan tombol jika alasan disetujui ada -->
                            <button type="button" class="btn btn-info btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#reasonModal" 
                                    data-alasan="{{ $peminjaman->alasan_disetujui }}"
                                    data-status="disetujui">
                                Lihat Keterangan
                            </button>
                        @elseif ($peminjaman->status === 'ditolak' && $peminjaman->alasan_ditolak)
                            <!-- Tampilkan tombol jika alasan ditolak ada -->
                            <button type="button" class="btn btn-info btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#reasonModal" 
                                    data-alasan="{{ $peminjaman->alasan_ditolak }}"
                                    data-status="ditolak">
                                Lihat Keterangan
                            </button>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="14" class="text-center">Tidak ada riwayat peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal untuk melihat keterangan -->
<div class="modal fade" id="reasonModal" tabindex="-1" aria-labelledby="reasonModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reasonModalLabel">Alasan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tampilkan alasan disetujui -->
                <p id="reasonText"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const reasonModal = new bootstrap.Modal(document.getElementById('reasonModal'));
        const reasonText = document.getElementById('reasonText');
        const modalTitle = document.getElementById('reasonModalLabel');

        // Menangani klik tombol "Lihat Keterangan"
        const lihatKeteranganButtons = document.querySelectorAll('button[data-bs-toggle="modal"]');
        lihatKeteranganButtons.forEach(button => {
            button.addEventListener('click', function () {
                const alasan = this.getAttribute('data-alasan');
                const status = this.getAttribute('data-status');
                
                // Update modal title based on status
                modalTitle.textContent = status === 'disetujui' ? 'Alasan Persetujuan' : 'Alasan Penolakan';
                reasonText.textContent = alasan;
                reasonModal.show();
            });
        });
    });
</script>
