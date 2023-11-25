<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Mapel;
use App\Models\Presensi;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function dashboard()
    {
        return view('contents.admin.dashboard.dashboard', [
            'title' => 'Dashboard',
            'siswa' => Mahasiswa::count(),
            'guru' => Dosen::count(),
            'mapel' => Mapel::count(),
            'kelas' => Kelas::count(),
            'presensis' => Presensi::where('guru_id', 0)->where('absensi_id', '!=', 2)->latest()->get()
        ]);
    }
}
