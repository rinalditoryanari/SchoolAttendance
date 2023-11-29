<?php

namespace App\Exports;

use App\Models\Absensi;
use App\Models\Pertemuan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RekapMhswMapel implements FromView
{
    protected $mapel;

    function __construct($mapel)
    {
        $this->mapel = $mapel;
    }
    public function view(): View
    {
        $pertemuans = Pertemuan::where('mapel_id', $this->mapel->id)->where('keterangan', 'masuk')->get();
        $mahasiswas = $this->mapel->kelas->mahasiswas;

        $presnsiSiswa = [];
        foreach ($mahasiswas as $mahasiswa) {
            $prensis = [];
            $rekap = []; // Initialize the rekap array for this mahasiswa

            foreach ($pertemuans as $pertemuan) {
                $presensi = $pertemuan->presensi->where('level', 'mahasiswa')->where('user_id', $mahasiswa->user->id)->first();

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
            'mapel' => $this->mapel,
            'kelas' => $this->mapel->kelas,
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
}
