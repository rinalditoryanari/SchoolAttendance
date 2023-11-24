<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    public function mapels()
    {
        return $this->hasMany(Mapel::class, "guru_id", 'id');
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
