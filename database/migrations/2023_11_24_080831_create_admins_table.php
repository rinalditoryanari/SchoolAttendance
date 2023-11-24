<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nik');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique();
            $table->string('photoProfile');
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->enum('jns_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->text('alamat');
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
        Schema::dropIfExists('admins');
    }
}
