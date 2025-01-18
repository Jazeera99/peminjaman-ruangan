<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{

    use HasFactory;

    // Nama tabel
    protected $table = 'peminjamen';

    // Kolom yang bisa diisi
    protected $fillable = [
        'tanggal_kegiatan',
        'waktu_mulai',
        'waktu_selesai',
        'room_id',
        'nama_ruangan',
        'nama_peminjam',
        'nama_ormawa',
        'nama_kegiatan',
        'jumlah_peserta',
        'keterangan',
        'nomor_Whatsapp',
    ];
    public function room()
    {
        return $this->belongsTo(Ruangan::class, 'room_id');
    }
}
