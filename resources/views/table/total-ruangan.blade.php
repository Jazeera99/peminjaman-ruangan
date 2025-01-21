@extends('layouts.app')
<div class="container">
    <!-- Tombol Unduh -->
    <div class="d-flex justify-content-between mb-3">
        <div class="text-center">
            <a class="btn btn-primary text-white" href="/addruangan">Tambah Ruangan</a>
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
                @forelse ($ruangans as $ruangan)
                    <tr>
                        <td>{{ $ruangan->id }}</td>
                        <td>{{ $ruangan->gedung }}</td>
                        <td>{{ $ruangan->nama }}</td>
                        <td>{{ $ruangan->deskripsi ?? '-' }}</td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm">EDIT</button>
                            <button class="btn btn-danger btn-sm">HAPUS</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Data ruangan belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
