<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('oauth_identities', static function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('provider');
            $table->string('social_id');
            $table->string('nickname')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('avatar')->nullable();
            $table->unique(['provider', 'social_id']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oauth_identities');
    }
};
