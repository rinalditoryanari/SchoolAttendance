<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaLoginController extends Controller
{
    public function index()
    {
        $mapels = Auth::user()->mahasiswa->kelas->mapels;
        $presensis = [];
        foreach ($mapels as $mapel) {
            $pertemuans = $mapel->pertemuans->where("keterangan", "masuk");
            foreach ($pertemuans as $pertemuan) {
                if ($pertemuan->presensi->where('absensi_id', '!=', 2)->toArray() != null) {
                    $presensis[] = $pertemuan->presensi->where('guru_id', 0)->where('absensi_id', '!=', 2);
                }
            }
        }
        if ($presensis) {
            $presensiss = $presensis[0];
        } else {
            $presensiss = [];
        }
        return view('contents.mahasiswa.dashboard.dashboard', [
            'title' => 'dashboard',
            'siswa' => Mahasiswa::count(),
            'guru' => User::count(),
            'mapel' => Mapel::count(),
            'kelas' => Kelas::count(),
            'presensis' => $presensiss,
        ]);
    }
}
