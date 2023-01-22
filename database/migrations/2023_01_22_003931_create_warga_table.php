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
        Schema::create('warga', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik')->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin',['L','P']);
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->foreignId('agama_id')->constrained('agama')->nullable();
            $table->foreignId('pendidikan_id')->constrained('pendidikan')->nullable();
            $table->foreignId('pekerjaan_id')->constrained('pekerjaan')->nullable();
            $table->foreignId('rw_id')->constrained('rw')->nullable();
            $table->foreignId('rt_id')->constrained('rt')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->string('status_hubungan')->nullable();
            $table->enum('status_perkawinan',['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'])->default('Belum Kawin');
            $table->date('tanggal_kawin')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('no_paspor')->nullable();
            $table->string('no_kitap')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
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
        Schema::dropIfExists('warga');
    }
};
