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
                        <td>{{ $peminjaman->nomor_Whatsapp }}</td>
                        <td>{{ $peminjaman->keterangan }}</td>
                        <td>{{ $peminjaman->pas_foto }}</td>
                        <td>{{ $peminjaman->file_tambahan }}</td> 
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm">EDIT</button>
                            <button class="btn btn-danger btn-sm">HAPUS</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
