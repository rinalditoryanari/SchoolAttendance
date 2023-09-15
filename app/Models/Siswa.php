<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Siswa extends  Authenticatable
{ 
    use HasFactory;

    protected $guarded = ['id'];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    
    public function presensis(){
        return $this->hasMany(Presensi::class);
    }

    use Notifiable;

    protected $table = 'siswas';

    protected $fillable = ['email',  'password'];

    protected $hidden = ['password',  'remember_token'];
}

// class Siswa extends Authenticatable
// {
//     use Notifiable;

//     protected $table = 'siswas';

//     protected $fillable = ['email',  'password'];

//     protected $hidden = ['password',  'remember_token'];
// }