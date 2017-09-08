<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateWepayAccountsTable
 *
 * @author  Rockers Technologies <jaimin.rockersinfo@gmail.com>
 */
class CreateWepayAccountsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wepay_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('type')->nullable();
            $table->string('imageUrl')->nullable();
            $table->string('gaqDomains')->nullable();
            $table->string('mcc')->nullable();
            $table->string('country')->nullable();
            $table->string('currencies')->nullable();
            $table->string('userId')->nullable();

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
        Schema::drop('wepay_accounts');
    }
}
