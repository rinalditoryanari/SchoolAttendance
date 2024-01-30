<?php

namespace App\Http\Controllers;

use App\Exports\PresensiDosenExport;
use App\Models\Absensi;
use App\Models\Dosen;
use App\Models\Pertemuan;
use App\Models\Presensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\PDF;

class DosenController extends Controller
{
    public function showAllDosen()
    {
        return view('contents.admin.data-dosen.show_all_dosen', [
            'title' => 'Data Dosen',
            'dosens' => Dosen::all(),
        ]);
    }

    public function showAddDosen()
    {
        return view('contents.admin.data-dosen.new-dosen', [
            'title' => 'Tambah Data Dosen',
        ]);
    }

    public function addDosen(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|unique:dosens|digits:16',
            'phone' => 'max:255|unique:dosens',
            'email' => 'max:255|unique:dosens',
            'password' => 'required|max:255',
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'tmpLahir' => 'max:255',
            'tglLahir' => '',
            'jns_kelamin' => '',
            'alamat' => '',
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create([
            'email' => $validatedData['email'],
            'firstName' => $validatedData['firstName'],
            'lastName' => $validatedData['lastName'],
            'password' => $validatedData['password'],
            "email_verified_at" => now(),
            "role" => 2,
        ]);

        $dosen = new Dosen($validatedData);
        $dosen->user_id = $user->id;
        $dosen->save();

        return redirect()->route('admin.dosen.showall')->with('success', 'Dosen baru telah ditambahkan!');
    }

    public function detailDosen(Dosen $dosen)
    {
        return view('contents.admin.data-dosen.detail-dosen', [
            'title' => 'Detail Data Dosen',
            'dosen' => $dosen
        ]);
    }

    public function showEditDosen(Dosen $dosen)
    {
        return view('contents.admin.data-dosen.edit-dosen', [
            'title' => 'Edit Data Dosen',
            'dosen' => $dosen,
        ]);
    }

    public function update(Request $request, Dosen $dosen)
    {
        $validatedData = $request->validate([
            'nik' => 'required|digits:16',
            'phone' => 'max:255',
            'email' => 'max:255',
            'password' => 'required|max:255',
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'tmpLahir' => 'max:255',
            'tglLahir' => '',
            'jnsKelamin' => '',
            'alamat' => '',
        ]);

        $dosen->user->password = bcrypt($validatedData['password']);
        $dosen->user->email = $validatedData['email'];
        $dosen->user->update();

        unset($validatedData['password']);
        $dosen->update($validatedData);

        return redirect()->route('admin.dosen.showall')->with('success', 'Data Dosen telah diupdate!');
    }

    public function delete(Dosen $dosen)
    {
        $dosen->user->delete();
        $dosen->delete();
        return redirect()->route('admin.dosen.showall')->with('success', 'Data dosen telah dihapus!');
    }

    public function reviewRekap(Dosen $dosen)
    {
        $tanggals = $dosen->mapels->flatMap(function ($mapel) {
            return $mapel->pertemuans->pluck('tanggal');
        })->unique()->sort();

        $presnsiMapel = [];
        foreach ($dosen->mapels as $mapel) {
            $prensis = [];
            $rekap = []; // Initialize the rekap array for this siswa
            foreach ($tanggals as $tanggal) {
                $pertemuan = Pertemuan::select('id')
                    ->where('mapel_id', $mapel->id)
                    ->where('tanggal', $tanggal)
                    ->where('keterangan', 'masuk')
                    ->first();
                if (isset($pertemuan)) {
                    $presensi = Presensi::select('absensi_id')
                        ->where('pertemuan_id', $pertemuan->id)
                        ->where('level', 'dosen')
                        ->first();

                    if (isset($presensi)) {
                        $absensi = $presensi->absensi->kode;
                    } else {
                        $absensi = 'A';
                    }
                } else {
                    $absensi = '-';
                }

                $prensis[] = [
                    'absensi' => $absensi,
                ];

                // Count the occurrences of each absensi kode in the rekap
                if (isset($rekap[$absensi])) {
                    $rekap[$absensi]++;
                } else {
                    $rekap[$absensi] = 1;
                }
            }
            // Append the rekap to the presnsiMapel array
            $presnsiMapel[] = [
                'detail' => $mapel,
                'kelas' => $mapel->kelas,
                'pertemuans' => $prensis,
                'rekaps' => $rekap, // Include the rekap in the output
            ];
        }
        return view('contents.admin.data-dosen.rekap-presensi', [
            'dosen' => $dosen,
            'pertemuans' => $tanggals,
            'mapels' => $presnsiMapel,
            'absensis' => Absensi::select('kode')->get(),
        ]);
    }

    public function excelRekap(Dosen $dosen)
    {
        return Excel::download(new PresensiDosenExport($dosen), 'Rekap Dosen' . $dosen->firsName . ' ' . $dosen->lastName . ' pada tanggal ' . date('Y-m-d') . '.xlsx');
    }

    public function pdfRekap(Dosen $dosen)
    {
        $tanggals = $dosen->mapels->flatMap(function ($mapel) {
            return $mapel->pertemuans->pluck('tanggal');
        })->unique()->sort();

        $presnsiMapel = [];
        foreach ($dosen->mapels as $mapel) {
            $prensis = [];
            $rekap = []; // Initialize the rekap array for this siswa
            foreach ($tanggals as $tanggal) {
                $pertemuan = Pertemuan::select('id')
                    ->where('mapel_id', $mapel->id)
                    ->where('tanggal', $tanggal)
                    ->where('keterangan', 'masuk')
                    ->first();
                if (isset($pertemuan)) {
                    $presensi = Presensi::select('absensi_id')
                        ->where('pertemuan_id', $pertemuan->id)
                        ->where('level', 'dosen')
                        ->first();

                    if (isset($presensi)) {
                        $absensi = $presensi->absensi->kode;
                    } else {
                        $absensi = 'A';
                    }
                } else {
                    $absensi = '-';
                }

                $prensis[] = [
                    'absensi' => $absensi,
                ];

                // Count the occurrences of each absensi kode in the rekap
                if (isset($rekap[$absensi])) {
                    $rekap[$absensi]++;
                } else {
                    $rekap[$absensi] = 1;
                }
            }
            // Append the rekap to the presnsiMapel array
            $presnsiMapel[] = [
                'detail' => $mapel,
                'kelas' => $mapel->kelas,
                'pertemuans' => $prensis,
                'rekaps' => $rekap, // Include the rekap in the output
            ];
        }

        $pdf = PDF::loadView('contents.admin.data-dosen.rekap-presensi', [
            'dosen' => $dosen,
            'pertemuans' => $tanggals,
            'mapels' => $presnsiMapel,
            'absensis' => Absensi::select('kode')->get(),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('Rekap Dosen' . $dosen->firsName . ' ' . $dosen->lastName . ' pada tanggal ' . date('Y-m-d') . '.pdf');
    }
}
