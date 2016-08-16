<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateTrackingTable
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreateTimeTrackerTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('time_tracker', function (Blueprint $table) {
            $table->increments('id');

            $table->timestamp('open_at')->nullable();
            $table->timestamp('close_at')->nullable();

            $table->string('status')->nullable()->default(NULL);
            $table->string('duration')->nullable();

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('time_tracker');
    }
}
