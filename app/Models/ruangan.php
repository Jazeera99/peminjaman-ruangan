<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak menggunakan nama default
    protected $table = 'ruangans';

    // Tentukan kolom-kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'gedung',
        'nama',
        'kapasitas',
        'deskripsi',
    ];

    // Relasi: Setiap ruangan memiliki banyak peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'room_id');
    }
}
