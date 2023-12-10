<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal', 'waktu', 'mapelkelas', 'sks', 'tipe', 'nominal', 'keterangan'];
    protected $guarded = ['id'];

    protected $attributes = [
        'waktu' => '',
        'mapel' => '',
        'sks' => '',
        'keterangan' => '',
        'nominal' => 0,
    ];
}
