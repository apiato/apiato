<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateStripeAccountsTable
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreateStripeAccountsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stripe_accounts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('customer_id');
            $table->string('card_id')->nullable();
            $table->string('card_funding')->nullable();
            $table->string('card_last_digits')->nullable();
            $table->string('card_fingerprint')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stripe_accounts');
    }
}
