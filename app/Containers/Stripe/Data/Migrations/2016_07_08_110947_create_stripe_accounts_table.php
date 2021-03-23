<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStripeAccountsTable extends Migration
{
    public function up(): void
    {
        Schema::create('stripe_accounts', function (Blueprint $table) {
            $table->id();

            $table->string('customer_id');
            $table->string('card_id')->nullable();
            $table->string('card_funding')->nullable();
            $table->string('card_last_digits')->nullable();
            $table->string('card_fingerprint')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::drop('stripe_accounts');
    }
}
