<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::create([
            'kode' => '1A',
            'nama' => 'Kelas 1A'
        ]);
        Kelas::create([
            'kode' => '1B',
            'nama' => 'Kelas 1B'
        ]);
        Kelas::create([
            'kode' => '2A',
            'nama' => 'Kelas 2A'
        ]);
        Kelas::create([
            'kode' => '2B',
            'nama' => 'Kelas 2B'
        ]);
        Kelas::create([
            'kode' => '3A',
            'nama' => 'Kelas 3A'
        ]);
        Kelas::create([
            'kode' => '3B',
            'nama' => 'Kelas 3B'
        ]);
        Kelas::create([
            'kode' => '3C',
            'nama' => 'Kelas 3C'
        ]);
        Kelas::create([
            'kode' => '4A',
            'nama' => 'Kelas 4A'
        ]);
        Kelas::create([
            'kode' => '4B',
            'nama' => 'Kelas 4B'
        ]);
        Kelas::create([
            'kode' => '5A',
            'nama' => 'Kelas 5A'
        ]);
        Kelas::create([
            'kode' => '5B',
            'nama' => 'Kelas 5B'
        ]);
        Kelas::create([
            'kode' => '5C',
            'nama' => 'Kelas 5C'
        ]);
        Kelas::create([
            'kode' => '6A',
            'nama' => 'Kelas 6A'
        ]);
        Kelas::create([
            'kode' => '6B',
            'nama' => 'Kelas 6B'
        ]);
    }
}
