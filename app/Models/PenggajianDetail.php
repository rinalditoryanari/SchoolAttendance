<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggajianDetail extends Model
{
    use HasFactory;

    protected $table = 'penggajian_details';

    protected $fillable = ['tanggal', 'waktu', 'mapelkelas', 'sks', 'tipe', 'nominal', 'keterangan'];
    protected $guarded = ['id'];

    protected $attributes = [
        'tanggal' => '',
        'waktu' => '',
        'mapelkelas' => '',
        'sks' => '',
        'keterangan' => '',
        'nominal' => 0,
    ];


    public function penggajian()
    {
        return $this->belongsTo(Penggajian::class);
    }
}
