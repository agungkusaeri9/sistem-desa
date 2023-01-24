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
        Schema::create('warga_pindahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('warga')->cascadeOnDelete();
            $table->string('alamat_tujuan')->nullable();
            $table->string('jalan')->nullable();
            $table->string('alasan')->nullable();
            $table->string('desa_tujuan');
            $table->string('rw');
            $table->string('rt');
            $table->string('kecamatan_tujuan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->date('tanggal');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('warga_pindahan');
    }
};
