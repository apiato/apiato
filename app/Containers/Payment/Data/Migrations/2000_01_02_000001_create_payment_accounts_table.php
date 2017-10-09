<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreatePaymentAccountsTable
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreatePaymentAccountsTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payment_accounts', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name')->nullable();

            $table->morphs('accountable');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
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
