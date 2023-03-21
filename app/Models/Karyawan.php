<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $with = ['users'];
    protected $guarded = [];



    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
