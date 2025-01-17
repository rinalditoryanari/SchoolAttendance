<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $guarded = ['id'];

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function mapels()
    {
        return $this->hasMany(Mapel::class);
    }
}
