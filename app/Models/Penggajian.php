<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;

    public function penggajian_details()
    {
        return $this->hasMany(PenggajianDetail::class);
    }
}
