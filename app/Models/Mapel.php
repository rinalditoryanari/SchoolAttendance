<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }

    public function pertemuans()
    {
        return $this->hasMany(Pertemuan::class);
    }
}
