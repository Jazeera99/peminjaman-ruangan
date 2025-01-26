@extends('layouts.app')
<div class="container mt-4">
    <!-- Tombol Unduh -->
    <div class="d-flex justify-content-between mb-3">
        <div class="text-center">
            <a class="btn btn-primary text-white" href="/adduser">Tambah User</a>
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
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm">EDIT</a>

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
                @endforeach
            </tbody>
        </table>
    </div>
