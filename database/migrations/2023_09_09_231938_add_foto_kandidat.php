<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFotoKandidat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kandidat', function (Blueprint $table) {
            $table->string('avatar_kandidat', 64)->nullable()->after('visi_misi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kandidat', function (Blueprint $table) {
            $table->dropColumn('avatar_kandidat');
        });
    }
}
