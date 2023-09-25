<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UPresensiAddMateri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'presensis',
            function (Blueprint $table) {
                // $table->id();
                // $table->foreignId('pertemuan_id')->after('id');
                // $table->dateTime('waktu_absen')->after('pertemuan_id');
                // $table->string('level')->after('waktu_absen');
                // $table->foreignId('siswa_id');
                // $table->foreignId('guru_id');
                // $table->foreignId('absensi_id');
                $table->foreignId('materi_id')->after('guru_id');
                $table->dropColumn('materi');
                // $table->timestamps();
            }
        );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'presensis',
            function (Blueprint $table) {
                // $table->id();
                // $table->foreignId('pertemuan_id')->after('id');
                // $table->dateTime('waktu_absen')->after('pertemuan_id');
                // $table->string('level')->after('waktu_absen');
                // $table->foreignId('siswa_id');
                // $table->foreignId('guru_id');
                // $table->foreignId('absensi_id');
                $table->longText('materi')->nullable()->after('absensi_id');
                $table->dropColumn('materi_id');
                // $table->timestamps();
            }
        );
    }
}
