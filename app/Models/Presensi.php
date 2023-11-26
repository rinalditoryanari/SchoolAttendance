<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = ['pertemuan_id', 'waktu_absen', 'siswa_id', 'absensi_id'];
    protected $guarded = ['id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'guru_id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    public function absensi()
    {
        return $this->belongsTo(Absensi::class);
    }

    public function pertemuans()
    {
        return $this->belongsTo(Pertemuan::class);
    }

    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
