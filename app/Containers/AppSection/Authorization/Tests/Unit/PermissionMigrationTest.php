<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit;

use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use Illuminate\Support\Facades\Schema;

/**
 * @group authorization
 * @group unit
 */
class PermissionMigrationTest extends UnitTestCase
{
    private array $tableNames;
    private array $columnNames;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tableNames = config('permission.table_names');
        $this->columnNames = config('permission.column_names');
    }

    public function testPermissionsTableHasExpectedColumns(): void
    {
        $columns = [
            'id',
            'name',
            'guard_name',
            'display_name',
            'description',
        ];

        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn($this->tableNames['permissions'], $column));
        }
    }

    public function testRolesTableHasExpectedColumns(): void
    {
        $columns = [
            'id',
            'name',
            'guard_name',
            'display_name',
            'description',
            'created_at',
            'updated_at',
        ];

        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn($this->tableNames['roles'], $column));
        }
    }

    public function testModelHasPermissionsTableHasExpectedColumns(): void
    {
        $columns = [
            'permission_id',
            'model_type',
            $this->columnNames['model_morph_key'],
        ];

        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn($this->tableNames['model_has_permissions'], $column));
        }
    }

    public function testModelHasRolesTableHasExpectedColumns(): void
    {
        $columns = [
            'role_id',
            'model_type',
            $this->columnNames['model_morph_key'],
        ];

        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn($this->tableNames['model_has_roles'], $column));
        }
    }

    public function testRoleHasPermissionsTableHasExpectedColumns(): void
    {
        $columns = [
            'permission_id',
            'role_id',
        ];

        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn($this->tableNames['role_has_permissions'], $column));
        }
    }
}
