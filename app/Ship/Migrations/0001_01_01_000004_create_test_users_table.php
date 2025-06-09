<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (app()->runningUnitTests()) {
            Schema::create('test_users', static function (Blueprint $table): void {
                $table->id();
                $table->string('name')->nullable();
                $table->string('email')->nullable();
                $table->integer('age')->nullable();
                $table->string('published')->nullable();
                $table->bigInteger('user_id')->nullable();
                $table->boolean('active')->default(true);
                $table->decimal('score', 3, 1)->nullable();
                $table->json('metadata')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('test_users');
    }
};
