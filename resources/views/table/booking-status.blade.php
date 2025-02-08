@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="text-left">
            <a href="{{ route('download.excel', ['month' => request('month'), 'year' => request('year'), 'search' => request('search')]) }}"
                class="btn btn-success">Unduh Excel</a>
            <a href="{{ route('download.pdf', ['month' => request('month'), 'year' => request('year'), 'search' => request('search')]) }}"
                class="btn btn-danger">Unduh PDF</a>
        </div>
        <!-- Form Filter -->
        <form action="{{ route('peminjaman.index') }}" method="GET" class="row g-3">
            @csrf
            <div class="col-md-6">
                <label for="search" class="form-label">Cari Data</label>
                <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}"
                    placeholder="Cari berdasarkan kata kunci...">
            </div>

            <div class="col-md-2">
                <label for="month" class="form-label">Bulan</label>
                <select name="month" id="month" class="form-control">
                    <option value="">Semua</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="col-md-2">
                <label for="year" class="form-label">Tahun</label>
                <select name="year" id="year" class="form-control">
                    <option value="">Semua</option>
                    @for ($y = now()->year; $y >= now()->year - 5; $y--)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>

        <hr>

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
                        @if ($peminjaman->status !== 'ditolak')
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
                                        <a href="{{ asset('storage/' . $peminjaman->pas_foto) }}" target="_blank"
                                            class="btn btn-sm btn-primary">
                                            Lihat Pas Foto
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if ($peminjaman->file)
                                        <a href="{{ asset('storage/' . $peminjaman->file) }}" target="_blank"
                                            class="btn btn-sm btn-primary">
                                            Lihat File
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $peminjaman->status }}
                                    @if ($peminjaman->status === 'disetujui' && $peminjaman->alasan_disetujui)
                                        <br><small>{{ $peminjaman->alasan_disetujui }}</small>
                                    @endif
                                </td>
                                <td class="d-flex justify-content-center">
                                    <!-- Button Disetujui -->
                                    <button class="btn btn-success btn-sm me-2" data-bs-toggle="modal"
                                        data-bs-target="#approveModal{{ $peminjaman->id }}">Disetujui</button>

                                    <!-- Button Ditolak -->
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#rejectModal{{ $peminjaman->id }}">Ditolak</button>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="14" class="text-center">Data peminjaman tidak ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Button to toggle rejected peminjaman -->
        <div class="text-center mt-4">
            <button class="btn btn-danger" id="tolak">Lihat Peminjaman Ditolak</button>
        </div>

        <!-- Table untuk menampilkan data yang ditolak -->
        <div class="table-responsive mt-4" id="rejectedTable" style="display: none;">
            <h4 style="text-align: center;">PEMINJAMAN DITOLAK</h4>
            <table class="table table-bordered table-hover table-danger">
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>TANGGAL</th>
                        <th>NAMA KEGIATAN</th>
                        <th>ALASAN DITOLAK</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjamanRuangans->where('status', 'ditolak') as $peminjaman)
                        <tr class="text-center">
                            <td>{{ $peminjaman->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_kegiatan)->format('d/m/Y') }}</td>
                            <td>{{ $peminjaman->nama_kegiatan }}</td>
                            <td>{{ $peminjaman->alasan_ditolak ?? 'Tidak ada alasan' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Alasan Persetujuan -->
        @foreach ($peminjamanRuangans as $peminjaman)
            <div class="modal fade" id="approveModal{{ $peminjaman->id }}" tabindex="-1"
                aria-labelledby="approveModalLabel{{ $peminjaman->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="approveModalLabel{{ $peminjaman->id }}">Alasan Persetujuan
                                Peminjaman
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('peminjaman.status', $peminjaman->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <input type="hidden" name="status" value="disetujui">

                                <!-- Alasan Persetujuan -->
                                <div class="mb-3">
                                    <label for="reason" class="form-label">Alasan Persetujuan</label>
                                    <textarea class="form-control" name="reason" id="reason{{ $peminjaman->id }}" rows="3" required></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Kirim Persetujuan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Modal Alasan Penolakan -->
        @foreach ($peminjamanRuangans as $peminjaman)
            <div class="modal fade" id="rejectModal{{ $peminjaman->id }}" tabindex="-1"
                aria-labelledby="rejectModalLabel{{ $peminjaman->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="rejectModalLabel{{ $peminjaman->id }}">Alasan Penolakan
                                Peminjaman
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('peminjaman.status', $peminjaman->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <input type="hidden" name="status" value="ditolak">

                                <!-- Alasan Penolakan -->
                                <div class="mb-3">
                                    <label for="reason" class="form-label">Alasan Penolakan</label>
                                    <textarea class="form-control" name="reason" id="reason{{ $peminjaman->id }}" rows="3" required></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection


