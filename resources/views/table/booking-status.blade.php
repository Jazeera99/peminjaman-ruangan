<div class="container mt-4">
    <div class="text-left">
        <a href="{{ route('download.excel', ['month' => request('month'), 'year' => request('year'), 'peminjam' => request('peminjam')]) }}"
            class="btn btn-success">Unduh Excel</a>
        <a href="{{ route('download.pdf', ['month' => request('month'), 'year' => request('year'), 'peminjam' => request('peminjam')]) }}"
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
                    <th>STATUS</th>
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
                        <td>{{ $peminjaman->user->nama ?? '-' }}</td>
                        <td>{{ $peminjaman->nama_kegiatan }}</td>
                        <td>{{ $peminjaman->nomor_Whatsapp }}</td>
                        <td>{{ $peminjaman->keterangan }}</td>
                        <td>{{ $peminjaman->pas_foto }}</td>
                        <td>{{ $peminjaman->file_tambahan }}</td>
                        <td class="text-center">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" name="status" class="form-control" required>
                                    <option value="disetujui">DISETUJUI</option>
                                    <option value="ditolak">DITOLAK</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal Alasan Penolakan -->
    <div class="modal fade" id="reasonModal" tabindex="-1" aria-labelledby="reasonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reasonModalLabel">Alasan Penolakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="reasonForm">
                        @csrf
                        <input type="hidden" id="peminjamanId" name="peminjaman_id">
                        <div class="mb-3">
                            <label for="reason" class="form-label">Alasan</label>
                            <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    