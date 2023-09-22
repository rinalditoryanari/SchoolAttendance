<?php

namespace Database\Seeders;

use App\Models\Absensi;
use Illuminate\Database\Seeder;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Absensi::create([
            'kode' => 'A',
            'keterangan' => 'Tanpa keterangan'
        ]);
        Absensi::create([
            'kode' => 'H',
            'keterangan' => 'Hadir'
        ]);
        Absensi::create([
            'kode' => 'S1',
            'keterangan' => 'Sakit dengan keterangan dari dokter'
        ]);
        Absensi::create([
            'kode' => 'S2',
            'keterangan' => 'Sakit tanpa surat dokter'
        ]);
        Absensi::create([
            'kode' => 'I',
            'keterangan' => 'Izin dengan surat izin'
        ]);
        Absensi::create([
            'kode' => 'D1',
            'keterangan' => 'Dispensasi acara didalam sekolah'
        ]);
        Absensi::create([
            'kode' => 'D2',
            'keterangan' => 'Dispensasi acara diluar sekolah'
        ]);
        Absensi::create([
            'kode' => 'T',
            'keterangan' => 'Terlambat'
        ]);
    }
}
