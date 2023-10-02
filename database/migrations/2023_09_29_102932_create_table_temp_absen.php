<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTempAbsen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_temp_absen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kegiatan');
            $table->foreign('id_kegiatan')->references('id')->on('ekstrakurikuler');
            $table->unsignedBigInteger('id_siswa');
            $table->foreign('id_siswa')->references('id')->on('users');
            $table->unsignedBigInteger('id_hari')->nullable();
            $table->foreign('id_hari')->references('id')->on('table_hari');
            $table->unsignedBigInteger('id_jadwal')->nullable();
            $table->foreign('id_jadwal')->references('id')->on('table_jadwal_hari');
            $table->date('tanggal')->nullable();
            $table->string('kehadiran', 1);
            $table->string('keterangan', 20)->nullable();
            $table->unsignedBigInteger('user_created')->nullable();
            $table->foreign('user_created')->references('id')->on('users');
            $table->unsignedBigInteger('user_updated')->nullable();
            $table->foreign('user_updated')->references('id')->on('users');
            $table->unsignedBigInteger('user_deleted')->nullable();
            $table->foreign('user_deleted')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_temp_absen');
    }
}
