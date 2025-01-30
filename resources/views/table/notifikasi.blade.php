@if ($ruanganTidakTersedia->isNotEmpty())
    <div class="table-responsive">
        <h4 style="text-align: center;">RUANGAN TIDAK TERSEDIA</h4>
        <table class="table table-bordered table-hover table-status">
            <thead class="table-danger text-center">
                <tr>
                    <th>GEDUNG</th>
                    <th>NAMA RUANGAN</th>
                    <th>KETERANGAN</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ruanganTidakTersedia as $ruangan)
                    <tr class="text-center">
                        <td>{{ $ruangan->gedung ?? '-' }}</td>
                        <td>{{ $ruangan->nama ?? '-' }}</td>
                        <td>{{ $ruangan->deskripsi ?? 'Tidak ada keterangan' }}</td>
                        <td>{{ $ruangan->status ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
