
        document.getElementById('toggleRejectedBtn').addEventListener('click', function() {
            const rejectedTable = document.getElementById('rejectedTable');
            if (rejectedTable.style.display === 'none') {
                rejectedTable.style.display = 'block';
                this.textContent = 'Sembunyikan Peminjaman Ditolak';
            } else {
                rejectedTable.style.display = 'none';
                this.textContent = 'Lihat Peminjaman Ditolak';
            }
        });
    