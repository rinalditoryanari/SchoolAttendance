<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nis')->unique();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('firstName')->nullable();;
            $table->string('lastName')->nullable();;
            $table->string('namaAyah')->nullable();;
            $table->string('namaIbu')->nullable();;
            $table->string('tmpLahir')->nullable();
            $table->date('tglLahir')->nullable();
            $table->enum('jnsKelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('alamat')->nullable();
            $table->foreignId('kelas_id')->nullable();
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiwas');
    }
}
