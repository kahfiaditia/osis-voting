<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasessModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clasess', function (Blueprint $table) {
            $table->id();
            $table->string('class_name', 25);
            $table->string('class_level', 25)->nullable();
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
        Schema::dropIfExists('clasess_models');
    }
}
