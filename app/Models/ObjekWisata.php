<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekWisata extends Model
{
    use HasFactory;

    protected $with = ['kategori_wisatas'];
    protected $guarded = [];


    public function kategori_wisatas()
    {
        return $this->belongsTo(KategoriWisata::class, 'kategori_wisata_id', 'id');
    }
}
