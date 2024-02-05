<?php

namespace App\Ship\Tests;

use App\Ship\Parents\Tests\PhpUnit\TestCase as ParentTestCase;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShipTestCase extends ParentTestCase
{
    protected function createTestUsersTable(): void
    {
        Schema::create('test_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age')->nullable();
            $table->string('published')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
