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
        'user_id', // Tambahkan user_id
        'nama_ormawa',
        'nama_kegiatan',
        'jumlah_peserta',
        'keterangan',
        'nomor_Whatsapp',
        'pas_foto',
        'file',
        'alasan_ditolak',
        'status',
    ];
    public function room()
    {
        return $this->belongsTo(Ruangan::class, 'room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}