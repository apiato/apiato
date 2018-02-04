<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateUserTableWithSocialauthColumns extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('social_provider')->nullable();
            $table->string('social_nickname')->nullable();
            $table->string('social_id')->nullable();
            $table->longText('social_token')->nullable();
            $table->longText('social_token_secret')->nullable();
            $table->longText('social_refresh_token')->nullable();
            $table->string('social_expires_in')->nullable();
            $table->string('social_avatar')->nullable();
            $table->string('social_avatar_original')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
//            $table->dropColumn('social_provider');
//            $table->dropColumn('social_nickname');
//            $table->dropColumn('social_id');
//            $table->dropColumn('social_token');
//            $table->dropColumn('social_token_secret');
//            $table->dropColumn('social_refresh_token');
//            $table->dropColumn('social_expires_in');
//            $table->dropColumn('social_avatar');
//            $table->dropColumn('social_avatar_original');
        });
    }
}
