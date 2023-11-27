<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Mapel;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(1)->create([
        //     'photoProfile' => 'photoProfile.jpg',
        // ]);

        $this->call([
            AdminSeeder::class,
            DosenSeeder::class,
            KelasSeeder::class,
            MapelSeeder::class,
            MahasiswaSeeder::class,
            AsdosSeeder::class,
            AbsensiSeeder::class,
        ]);
    }
}
