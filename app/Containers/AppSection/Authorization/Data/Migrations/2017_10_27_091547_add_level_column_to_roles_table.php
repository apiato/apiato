<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;

class AddLevelColumnToRolesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table(Config::get('permission.table_names.roles'), function (Blueprint $table) {
            $table->unsignedInteger('level')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(Config::get('permission.table_names.roles'), function (Blueprint $table) {
            $table->dropColumn('level');

        });
    }
}
