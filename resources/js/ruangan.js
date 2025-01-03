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
