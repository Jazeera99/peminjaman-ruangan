@if ($ruanganTidakTersedia->isNotEmpty())
<div class="table-responsive">
    <h4 style="text-align: center;">RUANGAN TIDAK TERSEDIA</h4>
    <table class="table table-bordered table-hover table-status">
        <thead class="table-danger text-center">
            <tr>
                <th>TANGGAL MULAI</th>
                <th>TANGGAL BERAKHIR</th>
                <th>WAKTU BERAKHIR</th>
                <th>GEDUNG</th>
                <th>NAMA RUANGAN</th>
                <th>KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ruanganTidakTersedia as $ruangan)
                <tr class="text-center">
                    <td>{{ $ruangan->tanggal_kegiatan->format('d/m/Y') }}</td>
                    <td>{{ $ruangan->tanggal_kegiatan->addDays(2)->format('d/m/Y') }}</td> <!-- Contoh tanggal berakhir -->
                    <td>{{ $ruangan->waktu_selesai }}</td>
                    <td>{{ $ruangan->room->gedung ?? '-' }}</td>
                    <td>{{ $ruangan->room->nama ?? '-' }}</td>
                    <td>{{ $ruangan->keterangan ?? 'Tidak ada keterangan' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
