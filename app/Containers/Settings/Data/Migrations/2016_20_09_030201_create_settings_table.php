<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key')->unique();
            $table->string('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('settings');
    }
}
