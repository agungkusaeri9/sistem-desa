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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('desa')->after('author')->nullable();
            $table->string('kode_pos')->after('desa')->nullable();
            $table->string('kecamatan')->after('kode_pos')->nullable();
            $table->string('kabupaten')->after('kecamatan')->nullable();
            $table->string('provinsi')->after('kabupaten')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->removeColumn('desa');
            $table->removeColumn('kode_pos');
            $table->removeColumn('kecamatan');
            $table->removeColumn('kabupaten');
            $table->removeColumn('provinsi');
        });
    }
};
