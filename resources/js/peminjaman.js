// Menunggu hingga halaman sepenuhnya dimuat
window.onload = function() {
    // Mendapatkan elemen tombol dan tabel
    const button = document.getElementById('tolak');
    const rejectedTable = document.getElementById('rejectedTable');

    // Cek apakah elemen-elemen ditemukan
    console.log(button, rejectedTable); // Debugging: apakah tombol dan tabel ditemukan?

    // Menambahkan event listener pada tombol
    button.addEventListener('click', function() {
        // Cek kondisi display tabel saat ini
        console.log('Button clicked, current display:', rejectedTable.style.display); // Debugging: tampilkan kondisi saat ini

        if (rejectedTable.style.display === 'none') {
            rejectedTable.style.display = 'block'; // Menampilkan tabel
            button.textContent = 'Sembunyikan Peminjaman Ditolak'; // Mengubah teks tombol
        } else {
            rejectedTable.style.display = 'none'; // Menyembunyikan tabel
            button.textContent = 'Lihat Peminjaman Ditolak'; // Mengubah teks tombol
        }
    });
}