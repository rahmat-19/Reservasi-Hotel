<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $with = ['paket_wisatas', 'pelanggans'];
    protected $guarded = [];

    public function paket_wisatas()
    {
        return $this->belongsTo(PaketWisata::class, 'paket_wisata_id', 'id');
    }

    public function pelanggans()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }
}
