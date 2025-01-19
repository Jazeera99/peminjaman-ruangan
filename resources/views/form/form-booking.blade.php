@extends('layouts.main')

@section('content')
    <div class="container mt-1">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <h4 class="card-header text-center">{{ __('FORM PEMINJAMAN RUANGAN') }}</h4>
                    <div class="card-body">
                        <form action="/submit-booking" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="form-control"
                                    placeholder="Masukkan nama Anda" required>
                            </div>

                            <div class="mb-3">
                                <label for="nomor_Whatsapp" class="form-label">NO WHATSAPP</label>
                                <input type="nomor_Whatsapp" id="nomor_Whatsapp" name="nomor_Whatsapp" class="form-control"
                                    placeholder="Masukkan nomor whatsapp Anda" required>
                            </div>

                            <!-- Nama Ruangan dan Tanggal -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="ruangan" class="form-label">Nama Ruangan</label>
                                    <select id="ruangan" name="ruangan" class="form-control" required>
                                        <option value="">-- Pilih Ruangan --</option>
                                        @foreach ($ruangans as $ruangan)
                                            <option value="{{ $ruangan->id }}">{{ $ruangan->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal" class="form-label">Tanggal Kegiatan</label>
                                    <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                                </div>
                            </div>

                            <!-- Waktu Mulai dan Selesai -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                                    <input type="time" id="waktu_mulai" name="waktu_mulai" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                                    <input type="time" id="waktu_selesai" name="waktu_selesai" class="form-control"
                                        required>
                                </div>
                            </div>

                            <!-- Organisasi -->
                            <div class="mb-3">
                                <label for="peminjam" class="form-label">Peminjam (Himatif/dll)</label>
                                <input type="text" id="peminjam" name="peminjam" class="form-control"
                                    placeholder="Organisasi Anda" required>
                            </div>

                            <!-- Nama Kegiatan -->
                            <div class="mb-3">
                                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                <input type="text" id="nama_kegiatan" name="nama_kegiatan" class="form-control" required>
                            </div>

                            <!-- Form Tambahan untuk Sarpras -->
                            <div id="sarpras-form" style="display: none;">
                                <div class="mb-3">
                                    <label for="jumlah_kursi" class="form-label">Jumlah Kursi</label>
                                    <input type="number" id="jumlah_kursi" name="jumlah_kursi" class="form-control"
                                        min="1">
                                </div>
                            </div>

                            <!-- Keterangan -->
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea id="keterangan" name="keterangan" class="form-control"></textarea>
                            </div>

                            {{-- Pas Foto --}}
                            <div class="mb-3">
                                <label for="pasFoto">Pas Foto</label>
                                <input type="file" name="pasFoto" id="pasFoto" class="form-control">

                            </div>

                            <!-- Upload Surat -->
                            <div class="mb-3">
                                <label for="file">Surat Permohonan (wajib) dan Lembar Disposisi (Jika Ada)</label>
                                <input type="file" name="file" id="file" class="form-control">
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tanggalInput = document.getElementById('tanggal');
            const ruanganInput = document.getElementById('ruangan');
            const sarprasForm = document.getElementById('sarpras-form');

            // Disable Sunday
            tanggalInput.addEventListener('change', function() {
                const selectedDate = new Date(this.value);
                if (selectedDate.getDay() === 0) { // 0 = Sunday
                    alert('Pemesanan tidak dapat dilakukan pada hari Minggu.');
                    this.value = '';
                }
            });

            // Toggle Sarpras Form
            ruanganInput.addEventListener('change', function() {
                if (this.value === 'Ruang Sarpras') {
                    sarprasForm.style.display = 'block';
                } else {
                    sarprasForm.style.display = 'none';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const ruanganInput = document.getElementById('ruangan');
            const tanggalInput = document.getElementById('tanggal');
            const waktuMulaiInput = document.getElementById('waktu_mulai');
            const waktuSelesaiInput = document.getElementById('waktu_selesai');
            const jumlahKursiInput = document.getElementById('jumlah_kursi');

            async function updateAvailableSeats() {
                const ruangan = ruanganInput.value;
                const tanggal = tanggalInput.value;
                const waktuMulai = waktuMulaiInput.value;
                const waktuSelesai = waktuSelesaiInput.value;

                if (ruangan && tanggal && waktuMulai && waktuSelesai) {
                    try {
                        const response = await fetch(
                            `/api/available-seats?ruangan=${ruangan}&tanggal=${tanggal}&waktu_mulai=${waktuMulai}&waktu_selesai=${waktuSelesai}`
                            );
                        const data = await response.json();

                        if (data.success) {
                            jumlahKursiInput.max = data.availableSeats;
                            jumlahKursiInput.placeholder = `Max ${data.availableSeats} kursi`;
                        } else {
                            alert(data.message);
                        }
                    } catch (error) {
                        console.error('Error fetching available seats:', error);
                    }
                }
            }

            ruanganInput.addEventListener('change', updateAvailableSeats);
            tanggalInput.addEventListener('change', updateAvailableSeats);
            waktuMulaiInput.addEventListener('change', updateAvailableSeats);
            waktuSelesaiInput.addEventListener('change', updateAvailableSeats);
        });
    </script>
@endsection
