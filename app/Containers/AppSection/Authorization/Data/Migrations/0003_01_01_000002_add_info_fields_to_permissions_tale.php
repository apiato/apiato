<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        $permissionsTableName = config('permission.table_names')['permissions'];
        Schema::table($permissionsTableName, static function (Blueprint $table): void {
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
        });
    }

    public function down(): void
    {
        $permissionsTableName = config('permission.table_names')['permissions'];
        Schema::table($permissionsTableName, static function (Blueprint $table): void {
            $table->dropColumn('display_name');
            $table->dropColumn('description');
        });
    }
};
