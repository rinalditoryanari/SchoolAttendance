<?php

namespace App\Http\Controllers;

use App\Exports\RekapSiswaMapel;
use App\Models\Absensi;
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
            foreach ($pertemuans as $pertemuan) {
                if ($pertemuan->keterangan == "masuk") {
                    $presensi = $pertemuan->presensi->where('level', 'guru')->first();
                    if ($presensi && $presensi->absensi_id == 2) {
                        $presensi_count++;
                    };
                }
            }
            $mapels[$i]->presensi_count =  $presensi_count;
        }

        return view('home.contents.admin.presensi.index', [
            'title' => 'Pilih Jadwal Mapel',
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
        request()->validate([
            'mapel' => 'required|numeric',
            'min_pertemuan' => 'required|numeric|min:1',
            'pertemuan' => 'required',
            'pertemuan.*' => 'required',
            'pertemuan.*.tanggal' => 'required|date',
            'pertemuan.*.masuk' => 'required|date_format:H:i',
            'pertemuan.*.keluar' => 'required|date_format:H:i|after:time_start',
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
                'waktu' => $pertemuan['masuk'],
                'keterangan' => 'masuk',
            ]);
            Pertemuan::insert([
                'mapel_id' => $mapel->id,
                'tanggal' => $pertemuan['tanggal'],
                'waktu' => $pertemuan['keluar'],
                'keterangan' => 'keluar',
            ]);
        }

        foreach (request('materi') as $materi) {
            Materi::insert([
                'mapel_id' => $mapel->id,
                'materi' => $materi['materi'],
            ]);
        }


        return redirect('/admin/presensi/');
    }

    //menampilkan tanggal pertemuan mapel
    public function showTgl(Mapel $mapel)
    {
        return view('home.contents.admin.presensi.tanggal', [
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
                    'id_masuk' => $pertemuan->id,
                    'masuk' => $pertemuan->waktu,
                    'id_keluar' => null,
                    'keluar' => null,
                ];
            } else {
                $cont = count($pertemuans);
                $pertemuans[$cont - 1]['id_keluar'] = $pertemuan->id;
                $pertemuans[$cont - 1]['keluar'] = $pertemuan->waktu;
            }
        }

        $materis = $mapel->materis;

        return view('home.contents.admin.presensi.edit', [
            'title' => 'Edit Presensi Mapel',
            'mapel' => $mapel,
            'pertemuans' => json_encode($pertemuans),
            'materis' => json_encode($materis),
        ]);
    }

    public function inputEdit(Request $request)
    {
        request()->validate([
            'mapel' => 'required|numeric',
            'min_pertemuan' => 'required|numeric|min:1',
            'pertemuan' => 'required',
            'pertemuan.*' => 'required',
            'pertemuan.*.tanggal' => 'required|date',
            'pertemuan.*.masuk' => 'required|date_format:H:i:s',
            'pertemuan.*.keluar' => 'required|date_format:H:i:s|after:time_start',
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
                        'waktu' => $data['masuk'],
                        'keterangan' => 'masuk',
                    ]);
                unset($existingPertemuan[$data['id_masuk']]); // Remove the ID from the array

                //keluar
                Pertemuan::where('id', $data['id_keluar'])
                    ->update([
                        'mapel_id' => $mapel,
                        'tanggal' => $data['tanggal'],
                        'waktu' => $data['keluar'],
                        'keterangan' => 'keluar',
                    ]);
                unset($existingPertemuan[$data['id_keluar']]); // Remove the ID from the array

            } else {
                // Data doesn't exist, so insert it as new
                Pertemuan::insert([
                    'mapel_id' => $mapel,
                    'tanggal' => $data['tanggal'],
                    'waktu' => $data['masuk'],
                    'keterangan' => 'masuk',
                ]);
                Pertemuan::insert([
                    'mapel_id' => $mapel,
                    'tanggal' => $data['tanggal'],
                    'waktu' => $data['keluar'],
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
        return redirect('/admin/presensi/');
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

        return redirect('/admin/presensi/');
    }

    public function showRekapGuru(Mapel $mapel)
    {
        $pertemuans = Pertemuan::where('mapel_id', $mapel->id)->get()->keyBy('id');


        $prensis = [];
        foreach ($pertemuans as $pertemuan) {
            $presensi = $pertemuan->presensi->where('level', 'guru')->first();

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

        return view('home.contents.admin.presensi.rekap-absen', [
            'title' => 'Presensi Rekap Guru',
            'mapel' => $mapel,
            'user' => $mapel->user,
            'pertemuans' => $prensis,
        ]);
    }

    public function showPilihRekapSiswa(Mapel $mapel)
    {
        return view('home.contents.admin.presensi.pilih-rekap-siswa', [
            'title' => 'Pilih Rekap Guru',
            'mapel' => $mapel,
            'siswas' => $mapel->kelas->siswas,
        ]);
    }

    public function showRekapSiswa(Mapel $mapel, Siswa $siswa)
    {
        $pertemuans = Pertemuan::where('mapel_id', $mapel->id)->get()->keyBy('id');


        $prensis = [];
        foreach ($pertemuans as $pertemuan) {
            $presensi = $pertemuan->presensi->where('level', 'siswa')->where('siswa_id', $siswa->id)->first();

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

        return view('home.contents.admin.presensi.rekap-absen', [
            'title' => 'Presensi Rekap Siswa',
            'mapel' => $mapel,
            'user' => $mapel->user,
            'pertemuans' => $prensis,
        ]);
    }

    public function excelRekapSiswa(Mapel $mapel)
    {
        return Excel::download(new RekapSiswaMapel($mapel), 'Rekap Siswa - ' . $mapel->nama . ' - ' . $mapel->kelas->nama . ' - ' . date('Y-m-d') . '.xlsx');
    }

    public function reviewRekapSiswa(Mapel $mapel)
    {
        $pertemuans = Pertemuan::where('mapel_id', $mapel->id)->where('keterangan', 'masuk')->get();
        $siswas = $mapel->kelas->siswas;

        $presnsiSiswa = [];
        foreach ($siswas as $siswa) {
            $prensis = [];
            $rekap = []; // Initialize the rekap array for this siswa

            foreach ($pertemuans as $pertemuan) {
                $presensi = $pertemuan->presensi->where('level', 'siswa')->where('siswa_id', $siswa->id)->first();

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
                'detail' => $siswa->toArray(),
                'pertemuans' => $prensis,
                'rekap' => $rekap, // Include the rekap in the output
            ];
        }

        return view('home.contents.admin.presensi.excel.siswa', [
            'mapel' => $mapel,
            'kelas' => $mapel->kelas,
            'jumlah' => [
                'siswa' => $siswas->count(),
                'laki' => $siswas->where('jnsKelamin', 'Laki-laki')->count(),
                'perempuan' => $siswas->where('jnsKelamin', 'Perempuan')->count(),
            ],
            'pertemuans' => $pertemuans,
            'siswas' => $presnsiSiswa,
            'absensis' => Absensi::select('kode')->get(),
        ]);
    }

    public function pdfRekapSiswa(Mapel $mapel)
    {
        $pertemuans = Pertemuan::where('mapel_id', $mapel->id)->where('keterangan', 'masuk')->get();
        $siswas = $mapel->kelas->siswas;

        $presnsiSiswa = [];
        foreach ($siswas as $siswa) {
            $prensis = [];
            $rekap = []; // Initialize the rekap array for this siswa

            foreach ($pertemuans as $pertemuan) {
                $presensi = $pertemuan->presensi->where('level', 'siswa')->where('siswa_id', $siswa->id)->first();

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
                'detail' => $siswa->toArray(),
                'pertemuans' => $prensis,
                'rekap' => $rekap, // Include the rekap in the output
            ];
        }

        $pdf = PDF::loadView('home.contents.admin.presensi.excel.siswa', [
            'mapel' => $mapel,
            'kelas' => $mapel->kelas,
            'jumlah' => [
                'siswa' => $siswas->count(),
                'laki' => $siswas->where('jnsKelamin', 'Laki-laki')->count(),
                'perempuan' => $siswas->where('jnsKelamin', 'Perempuan')->count(),
            ],
            'pertemuans' => $pertemuans,
            'siswas' => $presnsiSiswa,
            'absensis' => Absensi::select('kode')->get(),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('Rekap Siswa - ' . $mapel->nama . ' - ' . $mapel->kelas->nama . ' - ' . date('Y-m-d') . '.pdf');
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
