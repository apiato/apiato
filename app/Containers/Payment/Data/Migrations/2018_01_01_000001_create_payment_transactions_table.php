<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreatePaymentTransactionsTable
 *
 * @author Johannes Schobel <johannes.schobel@googlemail.com>
 */
class CreatePaymentTransactionsTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payment_transactions', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('gateway');
            $table->string('transaction_id');
            $table->string('status');
            $table->boolean('is_successful')->default(false);

            $table->string('amount')->default('0');
            $table->string('currency')->nullable()->default(null);

            $table->text('data')->nullable();

            $table->text('custom')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('payment_transactions');
    }
}
