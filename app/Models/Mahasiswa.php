<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Mahasiswa extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = 'mahasiswas';

    protected $guarded = ['id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function presensis()
    {
        return $this->hasMany(Presensi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
