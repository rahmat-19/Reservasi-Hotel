<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBerita extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function beritas()
    {
        return $this->hasMany(Berita::class, 'kategori_berita_id', 'id');
    }
}