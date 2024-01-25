<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Dosen;

class CreateAsdosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asdos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Dosen::class)->constrained()->cascadeOnDelete();
            $table->string('status');
            $table->string('nik')->unique();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('photoProfile')->nullable();
            $table->string('firstName');
            $table->string('lastName');
            $table->enum('jns_kelamin', ['Laki-laki', 'Perempuan']);
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
        Schema::dropIfExists('asdos');
    }
}
