<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Mapel;
use App\Models\Pertemuan;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\Siswa;
use DateTime;
use Illuminate\Support\Facades\Auth;

class PresensiSiswaController extends Controller
{
    //menampilkan seluruh mata pelajaran untuk kelas
    public function showMapel()
    {
        return view('home.contents.siswa.presensi.index', [
            'title' => 'Pilih Mapel',
            'mapels' => Auth::guard('siswa')->user()->kelas->mapels,
        ]);
    }

    //menampilkan tanggal pertemuan mapel
    public function showTgl(Mapel $mapel)
    {
        return view('home.contents.siswa.presensi.tanggal', [
            'title' => 'Pilih Tanggal Presensi',
            'pertemuans' => $mapel->pertemuans,
        ]);
    }

    //manmpilkan absensi pada pertemuan tsb
    public function showPresensi(Mapel $mapel, Pertemuan $pertemuan)
    {
        $presensi_guru = Presensi::select()->where('pertemuan_id', $pertemuan->id)->where('level', 'guru')->first();
        if ($presensi_guru) {

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

            return view('home.contents.siswa.presensi.create', [
                'title' => 'Presensi',
                'mapel' => $mapel,
                'materi' => $presensi_guru->materi,
                'pertemuan' => $pertemuan,
                'siswas' => $mapel->kelas->siswas,
                'telat' => $telat,
                'presensi' => Presensi::select()->where('pertemuan_id', $pertemuan->id)->where('level', 'siswa')->get(),
                'absensis' => Absensi::all()
            ]);
        } else {
            return back()->with('error', 'Absen belum dibuka, Pastikan guru telah absen!');
        }
    }

    //input data absensi
    public function inputAbsensi(Request $request)
    {
        $now = new DateTime('now');
        foreach ($request->presensi as $person) {
            Presensi::updateOrInsert([
                'pertemuan_id' => request('pertemuan'),
                'siswa_id' => $person['siswa'],
                'level' => 'siswa',
            ], [
                'waktu_absen' => $now->format('Y-m-d H:i:s'),
                'absensi_id' => $person['kehadiran'],
            ]);
        }
        return redirect('/siswa/presensi/' . request("mapel"));
    }
}
