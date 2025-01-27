PEMINJAMAN  MIGRATION

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id(); // Kolom ID
            $table->date('tanggal_kegiatan'); // Kolom TANGGAL
            $table->time('waktu_mulai'); // Kolom WAKTU MULAI
            $table->time('waktu_selesai'); // Kolom WAKTU SELESAI
            $table->unsignedBigInteger('room_id'); // Kolom RUANGAN
            $table->string('nama_ruangan', 100); // Kolom NAMA RUANGAN (ditambahkan)
            $table->string('nama_peminjam', 100); // Kolom PEMINJAM
            $table->string('nama_ormawa', 100); // Kolom ORGANISASI
            $table->string('nama_kegiatan', 100); // Kolom NAMA KEGIATAN
            $table->integer('jumlah_peserta'); // Kolom JUMLAH PESERTA
            $table->string('keterangan')->nullable(); // Kolom PERALATAN
            $table->string('nomor_Whatsapp', 15); // Kolom NO WHATSAPP
            $table->string('status', 20)->default('PENDING'); // Kolom STATUS
            $table->timestamps(); // Kolom untuk created_at dan updated_at
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};