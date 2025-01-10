@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <H4><div class="card-header text-center">{{ __('FORM PEMINJAMAN RUANGAN') }}</div></H4>
                <div class="card-body">
                    <form action="{{ route('submit.booking') }}" method="POST">
                        @csrf
                    
                        <!-- Nama Lengkap -->
                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-md-12">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama Anda" required>
                            </div>
                        </div>

                        <!-- Nama Ruangan -->
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="flex-grow-1">
                                <label for="ruangan" class="form-label">Nama Ruangan</label>
                                <select id="ruangan" name="ruangan" class="form-control" required>
                                    <option value="">-- Pilih Ruangan --</option>
                                    <option value="Ruang A">Ruang A</option>
                                    <option value="Ruang B">Ruang B</option>
                                    <option value="Ruang C">Ruang C</option>
                                </select>
                            </div>
                            <!-- Tanggal -->
                            <div class="flex-grow-1">
                                <label for="tanggal" class="form-label">Tanggal Kegiatan</label>
                                <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <!-- Waktu Mulai -->
                            <div class="flex-grow-1">
                                <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                                <input type="time" id="waktu_mulai" name="waktu_mulai" class="form-control" required>
                            </div>
                            <!-- Waktu Selesai -->
                            <div class="flex-grow-1">
                                <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                                <input type="time" id="waktu_selesai" name="waktu_selesai" class="form-control" max="18:00" required>
                            </div>
                        </div>

                        <!-- Organisasi -->
                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-md-12">
                                <label for="peminjam" class="form-label">Peminjam (Himatif/dll)</label>
                                <input type="text" id="peminjam" name="peminjam" class="form-control" placeholder="Organisasi Anda" required>
                            </div>
                        </div>

                        <!-- Organisasi -->
                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-md-12">
                                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                <input type="text" id="nama" name="nama" class="form-control"  required>
                            </div>
                        </div>

                        <!-- Form Tambahan (Ditampilkan jika ruangan Sarpras) -->
                        <div id="sarpras-form" style="display: none;">
                            <div class="mb-3">
                                <label for="jumlah_kursi" class="form-label">Jumlah Kursi</label>
                                <input type="number" id="jumlah_kursi" name="jumlah_kursi" class="form-control" min="1">
                                <small id="seat-availability" class="text-muted"></small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-md-12">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea id="keterangan" name="keterangan" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                            <label for="file">Surat Permohonan dan Lembar Disposisi (Jika Ada)</label>
                                <input type="file" name="file" id="file" required><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 offset-md-5">
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tanggalInput = document.getElementById('tanggal');

        // Disable Sunday
        tanggalInput.addEventListener('change', function () {
            const selectedDate = new Date(this.value);
            if (selectedDate.getDay() === 0) { // 0 = Sunday
                alert('Pemesanan tidak dapat dilakukan pada hari Minggu.');
                this.value = '';
            }
        });
    });
</script>
@endsection
