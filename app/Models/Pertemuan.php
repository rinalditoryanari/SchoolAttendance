<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    use HasFactory;

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class, "pertemuan_id", "id");
    }
}
