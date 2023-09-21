<?php

namespace App\Exports;

use App\Models\Absensi;
use App\Models\Pertemuan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RekapSiswaMapel implements FromView
{
    protected $mapel;

    function __construct($mapel)
    {
        $this->mapel = $mapel;
    }
    public function view(): View
    {
        $pertemuans = Pertemuan::where('mapel_id', $this->mapel->id)->where('keterangan', 'masuk')->get();
        $siswas = $this->mapel->kelas->siswas;

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
            'mapel' => $this->mapel,
            'kelas' => $this->mapel->kelas,
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
}
