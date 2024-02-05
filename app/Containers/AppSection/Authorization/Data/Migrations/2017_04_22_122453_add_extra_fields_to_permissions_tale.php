<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class() extends Migration {
    public function up(): void
    {
        $permissionsTableName = config('permission.table_names')['permissions'];
        Schema::table($permissionsTableName, function (Blueprint $table) {
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
        });
    }

    public function down(): void
    {
        $permissionsTableName = config('permission.table_names')['permissions'];
        Schema::table($permissionsTableName, function (Blueprint $table) {
            $table->dropColumn('display_name');
            $table->dropColumn('description');
        });
    }
};
