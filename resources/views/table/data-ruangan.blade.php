<div class="container mt-4">
    <!-- Tombol Unduh -->
    <div class="d-flex justify-content-between mb-3">
        <div>
            <h4>Data Ruangan</h4>
            <button class="btn btn-primary"><a href="/form/form-tambah-ruangan">TAMBAH RUANGAN</a></button>
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
                <tr>
                    <th>ROOM ID</th>
                    <th>GEDUNG</th>
                    <th>NAMA RUANGAN</th>
                    <th>KAPASITAS</th>
                    <th>DESKRIPSI</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <!-- Baris pertama -->
                <tr class="text-center">
                    <td>1</td>
                    <td>R 113</td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm" onclick="showEditForm(1)">EDIT</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteData(1)">HAPUS</button>
                    </td>
                </tr>
                <!-- Baris kedua -->
                <tr class="text-center">
                    <td>2</td>
                    <td>R 202</td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm">EDIT</button>
                        <button class="btn btn-danger btn-sm">HAPUS</button>
                    </td>
                </tr>
                <!-- Baris ketiga -->
                <tr class="text-center">
                    <td>3</td>
                    <td>R 108</td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm">EDIT</button>
                        <button class="btn btn-danger btn-sm">HAPUS</button>
                    </td>
                </tr>
                <!-- Baris keempat -->
                <tr class="text-center">
                    <td>4</td>
                    <td>R 101</td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm">EDIT</button>
                        <button class="btn btn-danger btn-sm">HAPUS</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
