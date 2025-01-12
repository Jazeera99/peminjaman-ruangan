<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    public function room()
    {
        return $this->belongsTo(Ruangan::class, 'room_id');
    }
}
