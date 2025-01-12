<div class="container mt-4">
    <!-- Tombol Unduh -->
    <div class="d-flex justify-content-between mb-3">
        <h4>Data Peminjaman Ruangan</h4>
        <div>
            <button class="btn btn-success me-2">Unduh Excel</button>
            <button class="btn btn-danger">Unduh PDF</button>
        </div>
    </div>

    <!-- Tabel -->
    <div class="table-auto">
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
                    <th>JUMLAH PESERTA</th>
                    <th>PERALATAN</th>
                    <th>NO WHATSAPP</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjamanRuangans as $peminjaman)
                    <tr>
                        <td>{{ $peminjaman->id }}</td>
                        <td>{{ $peminjaman->tanggal_kegiatan }}</td>
                        <td>{{ $peminjaman->waktu_mulai }}</td>
                        <td>{{ $peminjaman->waktu_selesai }}</td>
                        <td>{{ $peminjaman->room->nama ?? '-' }}</td>
                        <td>{{ $peminjaman->nama_peminjam }}</td>
                        <td>{{ $peminjaman->nama_ormawa }}</td>
                        <td>{{ $peminjaman->nama_kegiatan }}</td>
                        <td>{{ $peminjaman->jumlah_peserta }}</td>
                        <td>{{ $peminjaman->peralatan }}</td>
                        <td>{{ $peminjaman->nomor_Whatsapp }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
