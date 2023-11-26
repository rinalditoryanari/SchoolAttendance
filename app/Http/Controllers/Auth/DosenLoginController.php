<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Mapel;
use App\Models\Presensi;
use Illuminate\Http\Request;

class DosenLoginController extends Controller
{
    public function dashboard()
    {
        return view('contents.dosen.dashboard.dashboard', [
            'title' => 'Dashboard',
            'siswa' => Mahasiswa::count(),
            'dosen' => Dosen::count(),
            'mapel' => Mapel::count(),
            'kelas' => Kelas::count(),
            'presensis' => Presensi::where('dosen_id', 0)->where('absensi_id', '!=', 2)->latest()->get()
        ]);
    }
}
