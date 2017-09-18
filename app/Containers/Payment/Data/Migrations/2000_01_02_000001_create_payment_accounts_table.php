<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentAccountsTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payment_accounts', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('user_id')->unsigned();

            $table->string('name')->nullable();

            $table->morphs('accountable');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('payment_accounts');
    }
}
