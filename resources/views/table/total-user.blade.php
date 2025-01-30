<div class="container mt-4">
    <!-- Tombol Unduh -->
    <div class="d-flex justify-content-between mb-3">
        <div class="text-center">
            <a class="btn btn-primary text-white" href="/adduser">Tambah User</a>
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
                @foreach ($users as $user)
                    <tr>
                        <td>
                            @if ($user->created_at)
                                {{ $user->created_at->format('d-m-Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->password }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td class="text-center">
                            <!-- Tombol Edit -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editUserModal{{ $user->id }}">EDIT</button>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">HAPUS</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                        aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('user.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama_user" class="form-label">Nama User</label>
                                            <input type="text" id="nama_user" name="nama_user" class="form-control"
                                                value="{{ $user->nama }}" placeholder="Masukkan nama user" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                value="{{ $user->email }}" placeholder="Masukkan email user" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password (kosongkan jika tidak
                                                ingin diubah)</label>
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Masukkan password baru">
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="role">Role</label>
                                            <select id="role" name="role" class="form-control" required>
                                                <option value="">-- Pilih role --</option>
                                                <option value="ormawa" {{ $user->role == 'ormawa' ? 'selected' : '' }}>
                                                    Ormawa</option>
                                                <option value="ukm" {{ $user->role == 'ukm' ? 'selected' : '' }}>Ukm
                                                </option>
                                                <option value="baak" {{ $user->role == 'baak' ? 'selected' : '' }}>
                                                    BAAK</option>
                                                <option value="sarpras"
                                                    {{ $user->role == 'sarpras' ? 'selected' : '' }}>Sarpras</option>
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                                                    Admin</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Edit -->
                @endforeach
            </tbody>
        </table>
    </div>
