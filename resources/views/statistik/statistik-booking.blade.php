<div class="card shadow-sm p-4 mt-4">
    <h2 class="text-center mb-3">STATISTIK BOOKING</h2>
    <div class="row text-center">
        <div class="col-md-3">
            <p class="text-lg font-bold mb-0">{{ $pendingBookings }}</p>
            <p class="text-gray-600">Pending</p>
        </div>
        <div class="col-md-3">
            <p class="text-lg font-bold mb-0">{{ $ditolakBookings }}</p>
            <p class="text-gray-600">Ditolak</p>
        </div>
        <div class="col-md-3">
            <p class="text-lg font-bold mb-0">{{ $disetujuiBookings }}</p>
            <p class="text-gray-600">Disetujui</p>
        </div>
        <div class="col-md-3">
            <p class="text-lg font-bold mb-0">{{ $selesaiBookings }}</p>
            <p class="text-gray-600">Selesai</p>
        </div>
    </div>
    <div class="text-center mt-4">
        <p class="text-gray-600 mb-0">Total Permintaan Booking</p>
        <p class="text-lg font-bold">{{ $totalBookings }}</p>
    </div>
</div>