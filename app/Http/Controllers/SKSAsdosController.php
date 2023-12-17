<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SKSAsdosController extends Controller
{
    public function showSKS(Request $request)
    {
        if ($request->all()) {
            $validatedData = $request->validate([
                "tglawal" => 'required|date',
                "tglakhir" => 'required|date',
            ]);
            $pertemuans = SKSAsdosController::generateSKS($validatedData);
        } else {
            $pertemuans = null;
            $validatedData = null;
        }
        return view('contents.asdos.sks.show-sks', [
            'title' => 'Akumulasi',
            'pertemuans' => $pertemuans,
            'tanggal' => $validatedData,
        ]);
    }


    function generateSKS($date)
    {
        $user = auth()->user();

        $pertemuans = $user->asdos->dosen->mapels->flatMap(function ($mapel) {
            return $mapel->pertemuans;
        })->where('keterangan', 'masuk')->whereBetween('tanggal', [
            Carbon::parse($date['tglawal']),
            Carbon::parse($date['tglakhir']),
        ])->sortBy('tanggal');;

        foreach ($pertemuans as $pertemuan) {
            $presensi = $pertemuan->presensi->whereIn('level', ['dosen', 'asdos']);

            $absensi = ($presensi->where('user_id', $user->id)->isEmpty()) ? 'Tanpa Keterangan' : $presensi->where('user_id', $user->id)->first()->absensi->keterangan;

            $nama = ($presensi->isNotEmpty()) ? Auth::user()->firstName . " " . Auth::user()->lastName : "-";

            $presensi = $presensi->where('absensi_id', 2)->whereNotIn('user_id', $user->id)->first();

            $addition = ($presensi != null && $presensi->level == 'dosen') ? ' (Diisi oleh Dosen)' : '';
            $pertemuan->presensi = $absensi . ' ' . $addition;

            $pertemuan->nama = $nama;
        }
        return $pertemuans;
    }
}
