// resources/js/app.js

import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


// Fungsi untuk menampilkan form edit dengan data ruangan yang dipilih
function showEditForm(id) {
    const row = document.querySelector(`tr[data-id="${id}"]`);
    const namaRuangan = row.querySelector('.nama-ruangan').innerText;
    const kapasitasRuangan = row.querySelector('.kapasitas-ruangan').innerText;
  
    document.getElementById('ruanganId').value = id;
    document.getElementById('namaRuangan').value = namaRuangan;
    document.getElementById('kapasitasRuangan').value = kapasitasRuangan;
  
    document.getElementById('editRuanganForm').classList.remove('d-none');
  }
  
  // Fungsi untuk menyembunyikan form edit
  function hideEditForm() {
    document.getElementById('editRuanganForm').classList.add('d-none');
  }
  
  // Menangani submit form untuk memperbarui data di tabel
  document.getElementById('ruanganForm').addEventListener('submit', function (event) {
    event.preventDefault();
  
    const id = document.getElementById('ruanganId').value;
    const namaRuangan = document.getElementById('namaRuangan').value;
    const kapasitasRuangan = document.getElementById('kapasitasRuangan').value;
  
    // Update data di tabel
    const row = document.querySelector(`tr[data-id="${id}"]`);
    row.querySelector('.nama-ruangan').innerText = namaRuangan;
    row.querySelector('.kapasitas-ruangan').innerText = kapasitasRuangan;
  
    // Sembunyikan form
    hideEditForm();
  });
  
// Fungsi untuk menghapus data dari tabel
function deleteData(id) {
    // Konfirmasi penghapusan
    const confirmDelete = confirm("Apakah Anda yakin ingin menghapus data ini?");
    if (!confirmDelete) {
        return;
    }

    // Cari baris tabel berdasarkan ID
    const row = document.querySelector(`tr[data-id="${id}"]`);

    if (row) {
        // Hapus baris dari tabel
        row.remove();

        // (Opsional) Tampilkan pesan sukses
        alert("Data berhasil dihapus!");
    } else {
        alert("Data tidak ditemukan!");
    }
}

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

document.addEventListener("DOMContentLoaded", function () {
    const reasonModal = new bootstrap.Modal(document.getElementById('reasonModal'));
    const reasonText = document.getElementById('reasonText');

    // Menangani klik tombol "Lihat Keterangan"
    const lihatKeteranganButtons = document.querySelectorAll('button[data-bs-toggle="modal"]');
    lihatKeteranganButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Ambil alasan disetujui dan tampilkan di modal
            const alasan = this.getAttribute('data-alasan');
            reasonText.textContent = alasan; // Isi modal dengan alasan disetujui
            reasonModal.show(); // Tampilkan modal
        });
    });
});