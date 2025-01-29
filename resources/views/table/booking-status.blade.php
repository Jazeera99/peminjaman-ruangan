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

    <!-- Tabel Peminjaman -->
    <div class="table-auto">
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
                        <td>
                            @if ($peminjaman->pas_foto)
                                <img src="{{ asset('storage/' . $peminjaman->pas_foto) }}" alt="Pas Foto"
                                    width="50">
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($peminjaman->file)
                                <img src="{{ asset('storage/' . $peminjaman->file) }}" alt="Surat Permohonan"
                                    width="50">
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $peminjaman->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const showFormButton = document.getElementById('showFormButton');
        const hideFormButton = document.getElementById('hideFormButton');
        const formContainer = document.getElementById('formContainer');

        // Pastikan elemen ditemukan sebelum menambahkan event listener
        if (showFormButton && hideFormButton && formContainer) {
            showFormButton.addEventListener('click', function() {
                formContainer.style.display = 'block';
                showFormButton.style.display = 'none';
            });

            hideFormButton.addEventListener('click', function() {
                formContainer.style.display = 'none';
                showFormButton.style.display = 'block';
            });
        } else {
            console.error("Elemen yang diperlukan tidak ditemukan.");
        }
    });
</script>
