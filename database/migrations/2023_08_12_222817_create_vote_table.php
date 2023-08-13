<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote', function (Blueprint $table) {
            $table->id();
            $table->string('trx_number', 64);
            $table->unsignedBigInteger('id_user_vote')->nullable();
            $table->foreign('id_user_vote')->references('id')->on('users');
            $table->unsignedBigInteger('id_kandidat')->nullable();
            $table->foreign('id_kandidat')->references('id')->on('kandidat');
            $table->unsignedBigInteger('id_periode')->nullable();
            $table->foreign('id_periode')->references('id')->on('periode');
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
        Schema::dropIfExists('vote');
    }
}
