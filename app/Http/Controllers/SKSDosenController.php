<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SKSDosenController extends Controller
{
    public function showSKS(Request $request)
    {
        if ($request->all()) {
            $validatedData = $request->validate([
                "tglawal" => 'required|date',
                "tglakhir" => 'required|date',
            ]);
            $pertemuans = SKSDosenController::generateSKS($validatedData);
        } else {
            $pertemuans = null;
            $validatedData = null;
        }
        return view('contents.dosen.sks.show-sks', [
            'title' => 'Akumulasi',
            'pertemuans' => $pertemuans,
            'tanggal' => $validatedData,
        ]);
    }


    function generateSKS($date)
    {
        $user = auth()->user();

        $pertemuans = $user->dosen->mapels->flatMap(function ($mapel) {
            return $mapel->pertemuans;
        })->where('keterangan', 'masuk')->whereBetween('tanggal', [
            Carbon::parse($date['tglawal']),
            Carbon::parse($date['tglakhir']),
        ])->sortBy('tanggal');;

        foreach ($pertemuans as $pertemuan) {
            $presensi = $pertemuan->presensi->whereIn('level', ['dosen', 'asdos'])->first();
            if ($presensi) {
                $presensi->nama = $presensi->user->firstName . " " . $presensi->user->lastName;
            }
            $pertemuan->presensi = $presensi;
        }

        return $pertemuans;
    }
}
