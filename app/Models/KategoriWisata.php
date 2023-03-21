<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriWisata extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function objek_wisatas()
    {
        return $this->hasMany(ObjekWisata::class, 'kategori_wisata_id', 'id');
    }
}
