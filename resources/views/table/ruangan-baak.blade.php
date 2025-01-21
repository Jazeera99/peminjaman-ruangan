<div class="container mt-4">
    <!-- Tombol Unduh -->
    <div class="d-flex justify-content-between mb-3">
        <div class="text-center">
            <a class="btn btn-primary text-white" href="/form/form-tambah-ruangan">Tambah Ruangan</a>
        </div>
        <div>
            <button class="btn btn-success me-2">Unduh Excel</button>
            <button class="btn btn-danger">Unduh PDF</button>
        </div>
    </div>

    <!-- Tabel -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-status">
            <thead class="table-primary text-center">
                <tr style="text-align: center; vertical-align: middle;">
                    <th>ROOM ID</th>
                    <th>GEDUNG</th>
                    <th>NAMA RUANGAN</th>
                    <th>DESKRIPSI</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <!-- Baris pertama -->
                <tr class="text-center">
                    <td>1</td>
                    <td>Vokasi</td>
                    <td>R 113</td>
                    <td>Deskripsi tentang ruangan</td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm" onclick="showEditForm(1)">EDIT</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteData(1)">HAPUS</button>
                    </td>
                </tr>
                <!-- Baris kedua -->
                <tr class="text-center">
                    <td>2</td>
                    <td>FLTB</td>
                    <td>R 202 FLTB</td>
                    <td>Deskripsi tentang ruangan</td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm">EDIT</button>
                        <button class="btn btn-danger btn-sm">HAPUS</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
