<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class() extends Migration {
    public function up(): void
    {
        $rolesTableName = config('permission.table_names')['roles'];
        Schema::table($rolesTableName, function (Blueprint $table) {
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
        });
    }

    public function down(): void
    {
        $rolesTableName = config('permission.table_names')['roles'];
        Schema::table($rolesTableName, function (Blueprint $table) {
            $table->dropColumn('display_name');
            $table->dropColumn('description');
        });
    }
};
