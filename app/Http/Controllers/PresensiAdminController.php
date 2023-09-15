<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Mapel;
use App\Models\Pertemuan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresensiAdminController extends Controller
{
    public function showMapel()
    {
        $mapels = Mapel::has('pertemuans', '>', 0)->withCount(['pertemuans' => function ($query) {
            $query->where('keterangan', 'masuk');
        }])->get();

        return view('home.contents.admin.presensi.index', [
            'title' => 'Pilih Mapel',
            'mapels' => $mapels,
        ]);
    }

    //menampilkan halaman tambah presensi mapel
    public function showTambah()
    {
        $mapel = Mapel::doesntHave('pertemuans')->get();

        return view('home.contents.admin.presensi.create', [
            'title' => 'Tambah Presensi Mapel',
            'mapels' => $mapel,
        ]);
    }

    //menambahkan presensi mapel
    public function inputTambah()
    {
        // dd(request()->all());
        $mapel = request('mapel');
        foreach (request('pertemuan') as $pertemuan) {

            Pertemuan::insert([
                'mapel_id' => $mapel,
                'tanggal' => $pertemuan['tanggal'],
                'waktu' => $pertemuan['masuk'],
                'keterangan' => 'masuk',
            ]);
            Pertemuan::insert([
                'mapel_id' => $mapel,
                'tanggal' => $pertemuan['tanggal'],
                'waktu' => $pertemuan['keluar'],
                'keterangan' => 'keluar',
            ]);
        }

        return redirect('/admin/presensi/');
    }

    public function deletePresensi(Mapel $mapel)
    {
        $pertemuans = $mapel->pertemuans;

        foreach ($pertemuans as $pertemuan) {
            if ($pertemuan->presensi) {
                $pertemuan->presensi()->delete();
            }

            $pertemuan->delete();
        }

        return redirect('/admin/presensi/');
    }

    //menampilkan tanggal pertemuan mapel
    public function showTgl(Mapel $mapel)
    {
        return view('home.contents.admin.presensi.tanggal', [
            'title' => 'Pilih Tanggal Presensi',
            'pertemuans' => $mapel->pertemuans,
        ]);
    }

    public function showPresensiGuru(Mapel $mapel, Pertemuan $pertemuan)
    {
        return view('home.contents.admin.presensi.guru', [
            'title' => 'Presensi',
            'mapel' => $mapel,
            'pertemuan' => $pertemuan,
            'guru' => $mapel->user,
            'presensi' => Presensi::select()->where('pertemuan_id', $pertemuan->id)->where('level', 'guru')->first(),
            // 'absensis' => Absensi::all(),
        ]);
    }

    public function showPresensiSiswa(Mapel $mapel, Pertemuan $pertemuan)
    {
        return view('home.contents.admin.presensi.siswa', [
            'title' => 'Presensi',
            'mapel' => $mapel,
            'pertemuan' => $pertemuan,
            'siswas' => $mapel->kelas->siswas,
            'presensi' => Presensi::select()->where('pertemuan_id', $pertemuan->id)->where('level', 'siswa')->get(),
            // 'absensis' => Absensi::all()
        ]);
    }
}
