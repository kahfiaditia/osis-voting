<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlagFotoPeriode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('periode', function (Blueprint $table) {
            $table->string('type_foto', 15)->nullable()->after('periode_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('periode', function (Blueprint $table) {
            $table->dropColumn('type_foto');
        });
    }
}
