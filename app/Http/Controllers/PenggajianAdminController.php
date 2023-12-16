<?php

namespace App\Http\Controllers;

use App\Exports\GajiExport;
use App\Models\Asdos;
use App\Models\Dosen;
use App\Models\Penggajian;
use App\Models\Pertemuan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
        $data = PenggajianAdminController::preListGaji($user, $request);

        return view('contents.admin.gaji.show-gaji', [
            'title' => 'Penggajian',
            'tahuns' => $data['tahuns'],
            'user' => $data['user'],
            'data' => $data['data'],
            'tanggal' => $data['tanggal'],
            'input' => $data['input'],
        ]);
    }

    public function preListGaji(User $user, Request $request)
    {
        $pengajar = ($user->role === 2) ? $pengajar = $user->dosen : (($user->role === 3) ? $user->asdos->dosen : null);

        $pertemuans = $pengajar->mapels->flatMap(function ($mapel) {
            return $mapel->pertemuans;
        })->where('keterangan', 'masuk')->sortBy('tanggal');

        $tahun = $pertemuans->isNotEmpty() ? range(Carbon::parse($pertemuans->first()->tanggal)->year, Carbon::parse($pertemuans->last()->tanggal)->year) : [];

        if ($request->all()) {
            $validatedData = $request->validate([
                "bulan" => 'required|numeric',
                "tahun" => 'required|numeric',
            ]);

            $date = [
                'akhir' => Carbon::create($validatedData['tahun'], $validatedData['bulan'], 25),
                'awal' => Carbon::create($validatedData['tahun'], $validatedData['bulan'], 25)->subMonth()->addDay(),
            ];
            $data = PenggajianAdminController::listGaji($pertemuans, $date, $user);
        } else {
            $pertemuans = null;
            $validatedData = null;
            $data = null;
            $date = null;
        }

        return [
            'tahuns' => $tahun,
            'user' => $user,
            'data' => $data,
            'tanggal' => $date,
            'input' => $validatedData,
        ];
    }

    function listGaji($pertemuans, $date, User $user)
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
                $gaji = new Penggajian();
                $gaji->mapelkelas = $pertemuan->mapel->nama . ' - ' . $pertemuan->mapel->kelas->nama;
                $gaji->tanggal = $tanggal;
                $gaji->tipe = 'Per SKS';
                $gaji->sks = $pertemuan->sks;

                $presensi = $pertemuan->presensi->whereIn('level', ['dosen', 'asdos']);

                if ($presensi->isEmpty()) {
                    $gaji->keterangan = 'Tanpa keterangan';
                } elseif ($presensi->isNotEmpty()) {
                    $absensi = ($presensi->where('user_id', $user->id)->isEmpty()) ? 'Tanpa Keterangan' : $presensi->where('user_id', $user->id)->first()->absensi->keterangan;

                    $presensi = $presensi->where('absensi_id', 2);
                    if ($presensi->isNotEmpty()) {
                        $gaji->waktu = Carbon::parse($pertemuan->waktu)->isoFormat('HH:mm');
                        $data = $this->setGajiDetails($gaji, $absensi, $presensi, $pertemuan, $sks, $user, $work);

                        $gaji = $data[0];
                        $work = $data[1];
                    } else {
                        $gaji->keterangan = $absensi;
                    }
                }

                $row[] = $gaji;
                $total += $gaji->nominal;
            }

            $nominal = ($work === 0) ? 0 : $transport;
            $total += $nominal;

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

    private function setGajiDetails($gaji, $absensi, $presensi, $pertemuan, $sks, User $user, &$work)
    {
        $status = ($user->role === 2) ? 'dosen' : (($user->role === 3) ? 'asdos' : null);

        $presensi = $presensi->first();
        if ($presensi->user_id == $user->id) {
            $gaji->keterangan = $absensi;
            $gaji->nominal = $pertemuan->sks * $sks;
            $work++;
        } elseif ($presensi->level === 'asdos') {
            $gaji->keterangan = ($status === 'dosen') ? $absensi . ' (Diisi oleh Asisten Dosen)' : $absensi . ' (Diisi oleh Asisten Dosen Lainnya)';
        } elseif ($presensi->level === 'dosen' && $status === 'asdos') {
            $gaji->keterangan = $absensi . ' (Diisi oleh Dosen)';
        }

        return [$gaji, $work];
    }

    public function excelGaji(User $user, $bulan, $tahun)
    {
        $request = new Request([
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);
        $data = PenggajianAdminController::preListGaji($user, $request);
        return Excel::download(new GajiExport($data), 'Gaji ' . $user->firsName . ' ' . $user->lastName . ' pada periode ' . $data['input']['bulan'] . '-' . $data['input']['tahun'] . '.xlsx');
    }

    public function pdfGaji(User $user, $bulan, $tahun)
    {
        $request = new Request([
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);
        $data = PenggajianAdminController::preListGaji($user, $request);

        $pdf = FacadePdf::loadView('contents.admin.gaji.export-excel', [
            'title' => 'Penggajian',
            'tahuns' => $data['tahuns'],
            'user' => $data['user'],
            'data' => $data['data'],
            'tanggal' => $data['tanggal'],
            'input' => $data['input'],
        ])->setPaper('a4', 'landscape');

        return $pdf->download('Gaji ' . $user->firsName . ' ' . $user->lastName . ' pada periode ' . $data['input']['bulan'] . '-' . $data['input']['tahun']  . '.pdf');
    }


    public function saveGaji(Request $request)
    {
        $validatedData = $request->validate([
            'bulan' => 'required|numeric|min:1|max:12',
            'tahun' => 'required|numeric',
            'tambahan' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        dd($validatedData);
    }
}
