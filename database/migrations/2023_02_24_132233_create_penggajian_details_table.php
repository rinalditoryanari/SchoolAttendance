<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Penggajian;
class CreatePenggajianDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggajian_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Penggajian::class);
            $table->string('tanggal');
            $table->string('waktu');
            $table->string('mapelkelas');
            $table->integer('sks');
            $table->string('keterangan');
            $table->string('nominal');
            $table->string('tipe');
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
        Schema::dropIfExists('penggajian_details');
    }
}
