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
        'status',
    ];

    public static function gedungOptions()
    {
        return [
            'FLTB' => 'FLTB',
            'Pendidikan' => 'Pendidikan',
            'Anggrek' => 'Anggrek',
            'GOR' => 'GOR',
            'Auditorium' => 'Auditorium',
        ];
    }

    public static function getNamaRuangans()
    {
        return self::pluck('nama', 'id'); // Mengambil nama dan id ruangan
    }

    // Relasi: Setiap ruangan memiliki banyak peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'room_id');
    }
}
