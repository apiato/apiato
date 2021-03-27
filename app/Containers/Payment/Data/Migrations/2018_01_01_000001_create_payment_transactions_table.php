<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreatePaymentTransactionsTable
 */
class CreatePaymentTransactionsTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payment_transactions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')->constrained();

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
