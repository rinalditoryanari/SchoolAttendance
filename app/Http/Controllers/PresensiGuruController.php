<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Mapel;
use App\Models\Materi;
use App\Models\Pertemuan;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;

class PresensiGuruController extends Controller
{
    //menampilkan seluruh mata pelajaran untuk kelas
    public function showMapel()
    {
        return view('home.contents.guru.presensi.index', [
            'title' => 'Pilih Mapel',
            'mapels' => Auth::user()->mapels,
        ]);
    }

    //menampilkan tanggal pertemuan mapel
    public function showTgl(Mapel $mapel)
    {
        return view('home.contents.guru.presensi.tanggal', [
            'title' => 'Pilih Tanggal Presensi',
            'pertemuans' => $mapel->pertemuans,
        ]);
    }

    //manmpilkan absensi pada pertemuan tsb
    public function showPresensi(Mapel $mapel, Pertemuan $pertemuan)
    {

        //kalo absen masuk
        if ($pertemuan->keterangan == "masuk") {
            //batesnya sampe mapel selesai

            $limit = (Pertemuan::select("waktu")
                ->where('mapel_id', $pertemuan->mapel->id)
                ->where('tanggal', $pertemuan->tanggal)
                ->where('keterangan', 'keluar')
                ->first()
            )["waktu"];

            //kalo keluar
        } else if ($pertemuan->keterangan == "keluar") {
            //limitnya 30 menit setelah keluar
            $limit = date('H:i:s', strtotime("$pertemuan->waktu + 30 minutes"));
            // dd($limit);
        }

        if (
            //kalo bukan hari ini atau 
            $pertemuan->tanggal != date('Y-m-d') ||
            // lewat dari jam segini
            date('H:i:s') >= $limit
        ) {
            $telat = true;
        } else {
            $telat = false;
        }

        return view('home.contents.guru.presensi.create', [
            'title' => 'Presensi',
            'mapel' => $mapel,
            'pertemuan' => $pertemuan,
            'guru' => Auth::user(),
            'telat' => $telat,
            'presensi' => Presensi::select()->where('pertemuan_id', $pertemuan->id)->where('level', 'guru')->first(),
            'absensis' => Absensi::all(),
            'materis' => Materi::select()->where('mapel_id', $mapel->id)->get(),
        ]);
    }

    //input data absensi
    public function inputAbsensi(Request $request)
    {
        $now = new DateTime('now');

        $person = $request->presensi;
        Presensi::updateOrInsert([
            'pertemuan_id' => request('pertemuan'),
            'guru_id' => $person['guru'],
            'level' => 'guru',
        ], [
            'materi_id' => request('materi'),
            'waktu_absen' => $now->format('Y-m-d H:i:s'),
            'absensi_id' => $person['kehadiran'],
        ]);
        return redirect('/guru/presensi/' . request("mapel"));
    }
}
