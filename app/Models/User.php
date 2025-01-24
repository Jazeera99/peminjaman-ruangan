<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang dapat diisi (mass assignable).
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
    ];

    /**
     * Kolom yang harus disembunyikan untuk array.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Default casting atribut.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Setter untuk password (otomatis hashing).
     */

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'user_id');
    }
}
