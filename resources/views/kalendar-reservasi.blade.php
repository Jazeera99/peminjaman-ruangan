@extends('layouts.main')

@section('title', 'Lihat Ruangan')

@section('content')
    <div id="calendar"></div>

    <!-- Modal Detail Peminjaman -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Detail Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="eventInfo">
                    <p>Memuat data...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/get-events', // Memuat semua event dari server
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false // Hilangkan AM/PM
                },
                dateClick: function(info) {
                    $('#eventModal').modal('show');
                    $('#eventInfo').html('<p>Memuat data...</p>');

                    fetch(`/get-events-by-date?date=${info.dateStr}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.length > 0) {
                                let html = "<ul>";
                                data.forEach(event => {
                                    let waktuMulai = formatWaktu(event.waktu_mulai);
                                    let waktuSelesai = formatWaktu(event.waktu_selesai);

                                    html += `<li><b>Ruangan:</b> ${event.nama_ruangan}<br>
                                     <b>Nama Kegiatan:</b> ${event.nama_kegiatan}<br>
                                     <b>Nama Ormawa:</b> ${event.nama_ormawa}<br>
                                     <b>Waktu:</b> ${waktuMulai} - ${waktuSelesai}</li><hr>`;
                                });
                                html += "</ul>";
                                $('#eventInfo').html(html);
                            } else {
                                $('#eventInfo').html(
                                    '<p>Tidak ada peminjaman pada tanggal ini.</p>');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            $('#eventInfo').html('<p>Gagal memuat data.</p>');
                        });
                }
            });
            calendar.render();
        });

        // Fungsi untuk memformat waktu agar hanya menampilkan jam:menit
        function formatWaktu(timeString) {
            if (!timeString) return '-';
            let [hour, minute] = timeString.split(':');
            return `${hour}:${minute}`;
        }
    </script>
@endsection
