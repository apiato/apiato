<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->boolean('confirmed')->default(false);

            $table->string('gender')->nullable();
            $table->string('birth')->nullable();

            $table->string('social_provider')->nullable();
            $table->string('social_nickname')->nullable();
            $table->string('social_id')->nullable();
            $table->string('social_token')->nullable();
            $table->string('social_token_secret')->nullable();
            $table->string('social_refresh_token')->nullable();
            $table->string('social_expires_in')->nullable();
            $table->string('social_avatar')->nullable();
            $table->string('social_avatar_original')->nullable();

            $table->string('visitor_id')->unique()->nullable();
            $table->string('device')->nullable();
            $table->string('platform')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('users');
    }
}
