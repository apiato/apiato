<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Config;

class AddLevelColumnToRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(Config::get('permission.table_names.roles'), function (Blueprint $table) {

            $table->unsignedInteger('level')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Config::get('permission.table_names.roles'), function (Blueprint $table) {

            $table->dropColumn('level');

        });
    }
}
