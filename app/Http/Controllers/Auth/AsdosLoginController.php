<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Mapel;
use App\Models\Presensi;
use Illuminate\Http\Request;

class AsdosLoginController extends Controller
{
    public function dashboard()
    {
        return view('contents.asdos.dashboard.dashboard', [
            'title' => 'Dashboard',
            'mahasiswa' => Mahasiswa::count(),
            'dosen' => Dosen::count(),
            'mapel' => Mapel::count(),
            'kelas' => Kelas::count(),
            'presensis' => Presensi::where('user_id', 0)->where('level', 'dosen')->where('absensi_id', '!=', 2)->latest()->get()
        ]);
    }
}
