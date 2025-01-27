<div class="container mt-4">
    <!-- Tombol Unduh -->
    <div class="d-flex justify-content-between mb-3">
        <div class="text-center">
            <a class="btn btn-primary text-white" href="/form/form-tambah-user">Tambah User</a>
        </div>
        <div>
            @include('laporan.buat-laporan')
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabel -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-status">
            <thead class="table-primary text-center">
                <tr style="text-align: center; vertical-align: middle;">
                    <th>TANGGAL</th>
                    <th>NAMA LENGKAP</th>
                    <th>Email</th>
                    <th>PASSWORD</th>
                    <th>ROLE</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <!-- Baris ketiga -->
                <tr class="text-center">
                    <td>05/12/2024</td>
                    <td>Prof. Agus Pratama</td>
                    <td>ulbisarpras01@gmail.com</td>
                    <td>ulbisarpras01</td>
                    <td>SARPRAS</td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm">EDIT</button>
                        <button class="btn btn-danger btn-sm">HAPUS</button>
                    </td>
                </tr>
                <!-- Baris keempat -->
                <tr class="text-center">
                    <td>05/12/2024</td>
                    <td>Dr. Maya Sari</td>
                    <td>ulbisarpras02@gmail.com</td>
                    <td>ulbisarpras02</td>
                    <td>SARPRAS</td>
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm">EDIT</button>
                        <button class="btn btn-danger btn-sm">HAPUS</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
