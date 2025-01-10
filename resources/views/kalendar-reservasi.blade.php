@extends('layouts.main')

@section('title', 'Lihat Ruangan')

@section('content')
<div id="calendar"></div>

<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Detail Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="eventInfo"></div>
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
            events: '/get-events',
            dateClick: function(info) {
                $('#eventModal').modal('show');
                if (info.event) {
                    $('#eventInfo').html('<b>Ruangan:</b> ' + info.event.extendedProps.ruangan + '<br>' +
                                         '<b>Jam:</b> ' + moment(info.event.start).format('HH:mm') + ' - ' + moment(info.event.end).format('HH:mm') + '<br>' +
                                         '<b>Peminjam:</b> ' + info.event.extendedProps.peminjam);
                } else {
                    $('#eventInfo').html('Tidak ada peminjaman pada tanggal ini.');
                }
            }
        });
        calendar.render();
    });
</script>
@endsection
