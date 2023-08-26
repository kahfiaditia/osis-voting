<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('pin', 4)->nullable()->after('remember_token');
            $table->string('nis', 15)->after('pin');
            $table->string('address', 50)->nullable()->after('nis');
            $table->string('phone', 20)->nullable()->after('address');
            $table->string('avatar', 64)->nullable()->after('phone');
            $table->string('roles', 15)->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('avatar');
            $table->dropColumn('pin');
            $table->dropColumn('nis');
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('roles');
        });
    }
}
