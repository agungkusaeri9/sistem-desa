<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartu_keluarga', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('no_kartu_keluarga')->unique();
            $table->string('nama_kepala_keluarga');
            $table->string('alamat');
            $table->foreignId('rw_id')->constrained('rw')->nullable();
            $table->foreignId('rt_id')->constrained('rt')->nullable();
            $table->integer('kode_pos');
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
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
        Schema::dropIfExists('kartu_keluarga');
    }
};
