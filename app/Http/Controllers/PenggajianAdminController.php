<?php

namespace App\Http\Controllers;

use App\Models\Asdos;
use App\Models\Dosen;
use App\Models\Penggajian;
use App\Models\Pertemuan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;

class PenggajianAdminController extends Controller
{
    public function showAllPengajar()
    {
        $dosens = Dosen::all()->map(function ($dosen) {
            $dosen->status = "dosen";
            return $dosen;
        });
        $asdoss = Asdos::all()->map(function ($asdos) {
            $asdos->status = "asdos";
            return $asdos;
        });

        $pengajar = $asdoss->concat($dosens)->sortBy('firstName');
        return view('contents.admin.gaji.show-all-pengajar', [
            'title' => 'Daftar Pengajar',
            'pengajars' => $pengajar,
        ]);
    }

    public function showListGaji(User $user, Request $request)
    {

        if ($user->role === 2) {
            $pengajar = $user->dosen;
            $status = 'dosen';
        } elseif ($user->role === 3) {
            $pengajar = $user->asdos->dosen;
            $status = 'asdos';
        }

        $pertemuans = $pengajar->mapels->flatMap(function ($mapel) {
            return $mapel->pertemuans;
        })->where('keterangan', 'masuk')->sortBy('tanggal');

        $tahun_awal = $pertemuans->first()->tanggal;
        $tahun_awal = Carbon::parse($tahun_awal)->year;

        $tahun_akhir = $pertemuans->last()->tanggal;
        $tahun_akhir = Carbon::parse($tahun_akhir)->year;

        $tahun = collect(range($tahun_awal, $tahun_akhir))->toArray();


        if ($request->all()) {
            $validatedData = $request->validate([
                "bulan" => 'required|numeric',
                "tahun" => 'required|numeric',
            ]);

            $date['akhir'] = Carbon::create($validatedData['tahun'], $validatedData['bulan'], 25);
            $date['awal'] = Carbon::create($validatedData['tahun'], $validatedData['bulan'], 25)->subMonth()->addDay();

            $data = PenggajianAdminController::listGaji($pertemuans, $date, $status);
        } else {
            $pertemuans = null;
            $validatedData = null;
            $data = null;
            $date = null;
        }

        return view('contents.admin.gaji.show-gaji', [
            'title' => 'Penggajian',
            'tahuns' => $tahun,
            'user' => $user,
            'data' => $data,
            'tanggal' => $date,
            'input' => $validatedData,
        ]);
    }

    function listGaji($pertemuans, $date, $status)
    {
        $sks = 50000;
        $transport = 35000;
        $details = [];
        $total = 0;


        foreach ($pertemuans->whereBetween('tanggal', [$date['awal'], $date['akhir'],])->groupBy('tanggal') as $tgl => $pertemuanGroup) {
            $tanggal = Carbon::parse($tgl)->locale('id')->translatedFormat('l, j F Y');
            $row = [];
            $work = 0;

            foreach ($pertemuanGroup as $pertemuan) {
                $presensi = $pertemuan->presensi->whereIn('level', ['dosen', 'asdos']);

                $gaji = new Penggajian();
                $gaji->mapelkelas = $pertemuan->mapel->nama . ' - ' . $pertemuan->mapel->kelas->nama;
                $gaji->tanggal = $tanggal;
                $gaji->tipe = 'Per SKS';
                $gaji->sks = $pertemuan->sks;

                if ($presensi->isEmpty()) {
                    $gaji->keterangan = 'Tanpa keterangan';
                } elseif ($presensi->isNotEmpty()) {
                    $presensi = $presensi->first();

                    if ($presensi->level === 'asdos' && $status === 'dosen') {
                        $gaji->keterangan = $presensi->absensi->keterangan . ' (Asisten Dosen)';
                        $gaji->waktu = Carbon::parse($pertemuan->waktu)->isoFormat('HH:mm');
                    } elseif ($presensi->level === 'dosen' && $status === 'asdos') {
                        $gaji->keterangan = $presensi->absensi->keterangan . ' (Dosen)';
                        $gaji->waktu = Carbon::parse($pertemuan->waktu)->isoFormat('HH:mm');
                    } else {
                        $gaji->keterangan = $presensi->absensi->keterangan;
                        $gaji->nominal = $pertemuan->sks * $sks;
                        $gaji->waktu = Carbon::parse($pertemuan->waktu)->isoFormat('HH:mm');
                        $work++;
                    }
                } else {
                    $presensi = $pertemuan->presensi->where('level', $status)->first();

                    if ($presensi) {
                        $gaji->keterangan = $presensi->absensi->keterangan;
                    }
                }
                $row[] = $gaji;
                $total += $gaji->nominal;
            }

            $nominal = ($work === 0) ? 0 : $transport;
            $total += $nominal;

            // Add Transportasi entry
            $details[] = new Penggajian([
                'tanggal' => Carbon::parse($tgl)->locale('id')->translatedFormat('l, j F Y'),
                'tipe' => 'Transportasi',
                'nominal' => $nominal,
            ]);

            $details = array_merge($details, $row);
        }

        return [
            'total' =>  $total,
            'details' =>  $details,
        ];
    }
}
