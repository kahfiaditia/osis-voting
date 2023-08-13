<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKandidatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kandidat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ketua')->nullable();
            $table->foreign('id_ketua')->references('id')->on('users');
            $table->unsignedBigInteger('id_wakil')->nullable();
            $table->foreign('id_wakil')->references('id')->on('users');
            $table->unsignedBigInteger('id_periode')->nullable();
            $table->foreign('id_periode')->references('id')->on('periode');
            $table->string('quote', 256);
            $table->text('visi_misi')->nullable();
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
        Schema::dropIfExists('kandidat');
    }
}
