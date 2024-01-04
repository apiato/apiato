<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table(config('vendor-socialAuth.user.table_name'), function (Blueprint $table): void {
            $table->string('social_provider')->nullable();
            $table->string('social_nickname')->nullable();
            $table->string('social_id')->nullable();
            $table->longText('social_token')->nullable();
            $table->longText('social_token_secret')->nullable();
            $table->longText('social_refresh_token')->nullable();
            $table->string('social_expires_in')->nullable();
            $table->string('social_avatar')->nullable();
            $table->string('social_avatar_original')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table(config('vendor-socialAuth.user.table_name'), function (Blueprint $table): void {
            $table->dropColumn([
                'social_provider',
                'social_nickname',
                'social_id',
                'social_token',
                'social_token_secret',
                'social_refresh_token',
                'social_expires_in',
                'social_avatar',
                'social_avatar_original',
            ]);
        });
    }
};
