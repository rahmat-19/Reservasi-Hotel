<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketWisata extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class, 'paket_wisata_id', 'id');
    }
}
