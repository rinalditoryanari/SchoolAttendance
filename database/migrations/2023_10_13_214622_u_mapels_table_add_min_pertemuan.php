<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UMapelsTableAddMinPertemuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'mapels',
            function (Blueprint $table) {
                // $table->id();
                // $table->char('kode', 10)->unique();
                // $table->string('nama');
                // $table->foreignId('kelas_id');
                // $table->foreignId('guru_id');
                $table->integer('min_pertemuan')->nullable()->after("guru_id");
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
            'mapels',
            function (Blueprint $table) {
                // $table->id();
                // $table->char('kode', 10)->unique();
                // $table->string('nama');
                // $table->foreignId('kelas_id');
                // $table->foreignId('guru_id');
                $table->dropColumn('min_pertemuan')->nullable();
                // $table->timestamps();
            }
        );
    }
}
