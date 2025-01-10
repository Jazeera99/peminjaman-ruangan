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
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-status">
            <thead class="table-primary text-center">
                <tr>
                    <th>TANGGAL</th>
                    <th>WAKTU MULAI</th>
                    <th>WAKTU SELESAI</th>
                    <th>RUANGAN</th>
                    <th>PEMINJAM</th>
                    <th>NAMA KEGIATAN</th>
                    <th>PENANGGUNG JAWAB</th>
                    <th>NO HP</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <!-- Baris pertama -->
                <tr>
                    <td>05/12/2024</td>
                    <td>18:00</td>
                    <td>19:30</td>
                    <td>R. 113</td>
                    <td>HIMATIF</td>
                    <td>Rapat Himpunan</td>
                    <td>Laura</td>
                    <td>089645763465</td>
                    <td class="text-center">
                        <button class="btn btn-success btn-sm">SELESAI</button>
                    </td>
                </tr>
                <!-- Baris kedua -->
                <tr>
                    <td>05/12/2024</td>
                    <td>18:00</td>
                    <td>19:30</td>
                    <td>R. 113</td>
                    <td>MPM</td>
                    <td>Koordinasi MPM</td>
                    <td>Muhammad Rizqi</td>
                    <td>089786643545</td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm">DISETUJUI</button>
                    </td>
                </tr>
                <!-- Baris ketiga -->
                <tr>
                    <td>05/12/2024</td>
                    <td>18:00</td>
                    <td>19:30</td>
                    <td>R. 202</td>
                    <td>BEM</td>
                    <td>Sosialisasi Rapat</td>
                    <td>Fadli</td>
                    <td>089175646823</td>
                    <td class="text-center">
                        <button class="btn btn-warning btn-sm text-dark">PROSES</button>
                    </td>
                </tr>
                <!-- Baris keempat -->
                <tr>
                    <td>05/12/2024</td>
                    <td>18:00</td>
                    <td>19:30</td>
                    <td>R. 202</td>
                    <td>HIMALOGBIS</td>
                    <td>Ospek Jurusan</td>
                    <td>Raihan</td>
                    <td>089245458739</td>
                    <td class="text-center">
                        <button class="btn btn-danger btn-sm">REJECTED</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
