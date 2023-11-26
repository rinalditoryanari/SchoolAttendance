<?php

namespace App\Http\Controllers;

use App\Exports\RekapMhswMapel;
use App\Exports\RekapSiswaMapel;
use App\Models\Absensi;
use App\Models\Mahasiswa;
use App\Models\Mapel;
use App\Models\Materi;
use App\Models\Pertemuan;
use App\Models\Presensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\PDF;
use Exception;

class PresensiAdminController extends Controller
{
    public function showMapel()
    {
        $mapels = Mapel::has('pertemuans', '>', 0)->withCount(['pertemuans' => function ($query) {
            $query->where('keterangan', 'masuk');
        }])->get();

        for ($i = 0; $i < count($mapels); $i++) {
            $pertemuans = $mapels[$i]->pertemuans;
            $presensi_count = 0;
            $sks_count = 0;
            foreach ($pertemuans as $pertemuan) {
                if ($pertemuan->keterangan == "masuk") {
                    $presensi = $pertemuan->presensi->where('level', 'guru')->first();
                    if ($presensi && $presensi->absensi_id == 2) {
                        $presensi_count++;
                    };

                    $sks_count += $pertemuan->sks;
                }
            }
            $mapels[$i]->presensi_count =  $presensi_count;
            $mapels[$i]->sks_count =  $sks_count;
        }
        return view('contents.admin.presensi.all-mapel-presensi', [
            'title' => 'Pilih Jadwal Mapel',
            'mapels' => $mapels,
        ]);
    }

    //menampilkan halaman tambah presensi mapel
    public function showTambah()
    {
        $mapel = Mapel::doesntHave('pertemuans')->get();

        return view('contents.admin.presensi.create-mapel-presensi', [
            'title' => 'Tambah Presensi Mapel',
            'mapels' => $mapel,
        ]);
    }

    //menambahkan presensi mapel
    public function inputTambah()
    {
        request()->validate([
            'mapel' => 'required|numeric',
            'min_pertemuan' => 'required|numeric|min:1',
            'pertemuan' => 'required',
            'pertemuan.*' => 'required',
            'pertemuan.*.tanggal' => 'required|date',
            'pertemuan.*.sks' => 'required|numeric',
            'materi' => 'required',
            'materi.*.materi' => 'required|string'
        ], [
            'required' => 'Pastikan :attribute telah terisi.'
        ]);

        if (count(request('pertemuan')) < request('min_pertemuan')) {
            return back()->withErrors(["min_pertemuan" => "Pastikan daftar pertemuan memenuhi batas minimal pertemuan!"]);
        } else if (count(request('materi')) > count(request('pertemuan'))) {
            return back()->withErrors(["min_pertemuan" => "Pastikan daftar materi sesuai dengan banyak pertemuan!"]);
        }

        $mapel = Mapel::find(request('mapel'));
        $mapel->min_pertemuan = request('min_pertemuan');
        $mapel->save();

        foreach (request('pertemuan') as $pertemuan) {
            Pertemuan::insert([
                'mapel_id' => $mapel->id,
                'tanggal' => $pertemuan['tanggal'],
                'sks' => $pertemuan['sks'],
                'waktu' => null,
                'keterangan' => 'masuk',
            ]);
            Pertemuan::insert([
                'mapel_id' => $mapel->id,
                'tanggal' => $pertemuan['tanggal'],
                'sks' => $pertemuan['sks'],
                'waktu' => null,
                'keterangan' => 'keluar',
            ]);
        }

        foreach (request('materi') as $materi) {
            Materi::insert([
                'mapel_id' => $mapel->id,
                'materi' => $materi['materi'],
            ]);
        }

        return redirect()->route('admin.presensi.showmapel');
    }

    //menampilkan tanggal pertemuan mapel
    public function showTgl(Mapel $mapel)
    {
        return view('contents.admin.presensi.detail-mapel-presensi', [
            'title' => 'Pilih Tanggal Presensi',
            'mapel' => $mapel,
            'pertemuans' => $mapel->pertemuans,
        ]);
    }

    public function showEdit(Mapel $mapel)
    {
        // dd($mapel->pertemuans);
        $pertemuans = [];
        foreach ($mapel->pertemuans as $pertemuan) {
            if ($pertemuan->keterangan == "masuk") {
                $pertemuans[] = [
                    'tanggal' => $pertemuan->tanggal,
                    'sks' => $pertemuan->sks,
                    'id_masuk' => $pertemuan->id,
                    'id_keluar' => null,
                ];
            } else {
                $cont = count($pertemuans);
                $pertemuans[$cont - 1]['id_keluar'] = $pertemuan->id;
            }
        }

        $materis = $mapel->materis;

        return view('contents.admin.presensi.edit-mapel-presensi', [
            'title' => 'Edit Presensi Mapel',
            'mapel' => $mapel,
            'pertemuans' => json_encode($pertemuans),
            'materis' => json_encode($materis),
        ]);
    }

    public function inputEdit(Request $request)
    {
        // dd(request('pertemuan'));

        request()->validate([
            'mapel' => 'required|numeric',
            'min_pertemuan' => 'required|numeric|min:1',
            'pertemuan' => 'required',
            'pertemuan.*' => 'required',
            'pertemuan.*.tanggal' => 'required|date',
            'pertemuan.*.sks' => 'required|numeric',
            'materi' => 'required',
            'materi.*.materi' => 'required|string'
        ], [
            'required' => 'Pastikan :attribute telah terisi.'
        ]);

        if (count(request('pertemuan')) < request('min_pertemuan')) {
            return back()->withErrors(["min_pertemuan" => "Pastikan daftar pertemuan memenuhi batas minimal pertemuan!"]);
        } else if (count(request('materi')) > count(request('pertemuan'))) {
            return back()->withErrors(["min_pertemuan" => "Pastikan daftar materi sesuai dengan banyak pertemuan!"]);
        }

        $mapel = Mapel::find(request('mapel'));
        $mapel->min_pertemuan = request('min_pertemuan');
        $mapel->save();

        $mapel = $request->mapel;

        $existingPertemuan = Pertemuan::where('mapel_id', $mapel)->get()->keyBy('id');
        foreach ($request->pertemuan as $data) {
            $id = $data['id_masuk'];
            if (isset($existingPertemuan[$id])) {
                //masuk
                Pertemuan::where('id', $data['id_masuk'])
                    ->update([
                        'mapel_id' => $mapel,
                        'tanggal' => $data['tanggal'],
                        'sks' => $data['sks'],
                        'keterangan' => 'masuk',
                    ]);
                unset($existingPertemuan[$data['id_masuk']]); // Remove the ID from the array

                //keluar
                Pertemuan::where('id', $data['id_keluar'])
                    ->update([
                        'mapel_id' => $mapel,
                        'tanggal' => $data['tanggal'],
                        'sks' => $data['sks'],
                        'keterangan' => 'keluar',
                    ]);
                unset($existingPertemuan[$data['id_keluar']]); // Remove the ID from the array

            } else {
                // Data doesn't exist, so insert it as new
                Pertemuan::insert([
                    'mapel_id' => $mapel,
                    'tanggal' => $data['tanggal'],
                    'sks' => $data['sks'],
                    'keterangan' => 'masuk',
                ]);
                Pertemuan::insert([
                    'mapel_id' => $mapel,
                    'tanggal' => $data['tanggal'],
                    'sks' => $data['sks'],
                    'keterangan' => 'keluar',
                ]);
            }
        }

        foreach ($existingPertemuan as $pertemuan) {
            $pertemuan->delete();
        }

        $existingMateri = Materi::where('mapel_id', $mapel)->get()->keyBy('id');
        foreach ($request->materi as $data) {
            $id = $data['id'];
            if (isset($existingMateri[$id])) {
                //masuk
                Materi::where('id', $data['id'])
                    ->update([
                        'materi' => $data['materi'],
                    ]);
                unset($existingMateri[$data['id']]);
            } else {
                Materi::insert([
                    'mapel_id' => $mapel,
                    'materi' => $data['materi'],
                ]);
            }
        }

        foreach ($existingMateri as $materi) {
            $materi->delete();
        }
        return redirect()->route('admin.presensi.showmapel');
    }


    public function deletePresensi(Mapel $mapel)
    {
        $pertemuans = $mapel->pertemuans;
        $mapel->materis()->delete();

        foreach ($pertemuans as $pertemuan) {
            if ($pertemuan->presensi) {
                $pertemuan->presensi()->delete();
            }

            $pertemuan->delete();
        }

        return redirect()->route('admin.presensi.showmapel');
    }

    public function showRekapDosen(Mapel $mapel)
    {
        $pertemuans = Pertemuan::where('mapel_id', $mapel->id)->get()->keyBy('id');


        $prensis = [];
        foreach ($pertemuans as $pertemuan) {
            $presensi = $pertemuan->presensi->where('level', 'dosen')->first();

            if ($presensi) {
                $absensi = $presensi->absensi->kode . ' - ' . $presensi->absensi->keterangan;
            } else {
                $absensi = 'Tidak Absen';
            };

            $prensis[] = [
                'detail' => $pertemuan,
                'presensi' => $presensi,
                'absensi' => $absensi,
            ];
        }

        return view('contents.admin.presensi.rekap.rekap-dosen', [
            'title' => 'Presensi Rekap Dosen',
            'mapel' => $mapel,
            'dosen' => $mapel->dosen,
            'pertemuans' => $prensis,
        ]);
    }

    public function showPilihRekapMhsw(Mapel $mapel)
    {
        return view('contents.admin.presensi.rekap.all-mhsw', [
            'title' => 'Pilih Rekap Mahasiswa',
            'mapel' => $mapel,
            'mahasiswas' => $mapel->kelas->mahasiswas,
        ]);
    }

    public function showRekapMhsw(Mapel $mapel, Mahasiswa $mahasiswa)
    {
        $pertemuans = Pertemuan::where('mapel_id', $mapel->id)->get()->keyBy('id');

        $prensis = [];
        foreach ($pertemuans as $pertemuan) {
            $presensi = $pertemuan->presensi->where('level', 'mahasiswa')->where('mahasiswa_id', $mahasiswa->id)->first();

            if ($presensi) {
                $absensi = $presensi->absensi->kode . ' - ' . $presensi->absensi->keterangan;
            } else {
                $absensi = 'Tidak Absen';
            };

            $prensis[] = [
                'detail' => $pertemuan,
                'presensi' => $presensi,
                'absensi' => $absensi,
            ];
        }

        return view('contents.admin.presensi.rekap.detail-mhsw', [
            'title' => 'Presensi Rekap Mahasiswa',
            'mapel' => $mapel,
            'mahasiswa' => $mahasiswa,
            'pertemuans' => $prensis,
        ]);
    }

    public function excelRekapMhsw(Mapel $mapel)
    {
        return Excel::download(new RekapMhswMapel($mapel), 'Rekap Mahasiswa - ' . $mapel->nama . ' - ' . $mapel->kelas->nama . ' - ' . date('Y-m-d') . '.xlsx');
    }

    public function reviewRekapMhsw(Mapel $mapel)
    {
        $pertemuans = Pertemuan::where('mapel_id', $mapel->id)->where('keterangan', 'masuk')->get();
        $mahasiswas = $mapel->kelas->mahasiswas;

        $presnsiSiswa = [];
        foreach ($mahasiswas as $mahasiswa) {
            $prensis = [];
            $rekap = []; // Initialize the rekap array for this mahasiswa

            foreach ($pertemuans as $pertemuan) {
                $presensi = $pertemuan->presensi->where('level', 'mahasiswa')->where('mahasiswa_id', $mahasiswa->id)->first();

                if ($presensi) {
                    $absensi = $presensi->absensi->kode;
                } else {
                    $absensi = 'A';
                };

                $prensis[] = [
                    'detail' => $pertemuan->toArray(),
                    'absensi' => $absensi,
                ];

                // Count the occurrences of each absensi kode in the rekap
                if (isset($rekap[$absensi])) {
                    $rekap[$absensi]++;
                } else {
                    $rekap[$absensi] = 1;
                }
            }

            // Append the rekap to the presnsiSiswa array
            $presnsiSiswa[] = [
                'detail' => $mahasiswa->toArray(),
                'pertemuans' => $prensis,
                'rekap' => $rekap, // Include the rekap in the output
            ];
        }

        return view('contents.admin.presensi.rekap.excel-rekap', [
            'mapel' => $mapel,
            'kelas' => $mapel->kelas,
            'jumlah' => [
                'mahasiswa' => $mahasiswas->count(),
                'laki' => $mahasiswas->where('jnsKelamin', 'Laki-laki')->count(),
                'perempuan' => $mahasiswas->where('jnsKelamin', 'Perempuan')->count(),
            ],
            'pertemuans' => $pertemuans,
            'mahasiswas' => $presnsiSiswa,
            'absensis' => Absensi::select('kode')->get(),
        ]);
    }

    public function pdfRekapMhsw(Mapel $mapel)
    {
        $pertemuans = Pertemuan::where('mapel_id', $mapel->id)->where('keterangan', 'masuk')->get();
        $mahasiswas = $mapel->kelas->mahasiswas;

        $presnsiSiswa = [];
        foreach ($mahasiswas as $mahasiswa) {
            $prensis = [];
            $rekap = []; // Initialize the rekap array for this mahasiswa

            foreach ($pertemuans as $pertemuan) {
                $presensi = $pertemuan->presensi->where('level', 'mahasiswa')->where('mahasiswa_id', $mahasiswa->id)->first();

                if ($presensi) {
                    $absensi = $presensi->absensi->kode;
                } else {
                    $absensi = 'A';
                };

                $prensis[] = [
                    'detail' => $pertemuan->toArray(),
                    'absensi' => $absensi,
                ];

                // Count the occurrences of each absensi kode in the rekap
                if (isset($rekap[$absensi])) {
                    $rekap[$absensi]++;
                } else {
                    $rekap[$absensi] = 1;
                }
            }

            // Append the rekap to the presnsiSiswa array
            $presnsiSiswa[] = [
                'detail' => $mahasiswa->toArray(),
                'pertemuans' => $prensis,
                'rekap' => $rekap, // Include the rekap in the output
            ];
        }

        $pdf = PDF::loadView('contents.admin.presensi.rekap.excel-rekap', [
            'mapel' => $mapel,
            'kelas' => $mapel->kelas,
            'jumlah' => [
                'mahasiswa' => $mahasiswas->count(),
                'laki' => $mahasiswas->where('jnsKelamin', 'Laki-laki')->count(),
                'perempuan' => $mahasiswas->where('jnsKelamin', 'Perempuan')->count(),
            ],
            'pertemuans' => $pertemuans,
            'mahasiswas' => $presnsiSiswa,
            'absensis' => Absensi::select('kode')->get(),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('Rekap Mahasiswa - ' . $mapel->nama . ' - ' . $mapel->kelas->nama . ' - ' . date('Y-m-d') . '.pdf');
    }

    public function showPresensiDosen(Mapel $mapel, Pertemuan $pertemuan)
    {
        return view('contents.admin.presensi.harian.harian-dosen', [
            'title' => 'Presensi',
            'mapel' => $mapel,
            'pertemuan' => $pertemuan,
            'dosen' => $mapel->dosen,
            'presensi' => Presensi::select()->where('pertemuan_id', $pertemuan->id)->where('level', 'dosen')->first(),
        ]);
    }

    public function showPresensiMhsw(Mapel $mapel, Pertemuan $pertemuan)
    {
        return view('contents.admin.presensi.harian.harian-mahasiswa', [
            'title' => 'Presensi',
            'mapel' => $mapel,
            'pertemuan' => $pertemuan,
            'mahasiswas' => $mapel->kelas->mahasiswas,
            'presensi' => Presensi::select()->where('pertemuan_id', $pertemuan->id)->where('level', 'mahasiswa')->get(),
        ]);
    }
}
