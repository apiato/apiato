<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Migrations;

use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class MigrationTest extends UnitTestCase
{
    private array $tableNames;

    private array $columnNames;

    public function testPermissionsTableHasExpectedColumns(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        $bigint = match ($driver) {
            'sqlite' => 'integer',
            'pgsql'  => 'int8',
            default  => 'bigint',
        };
        $string = match ($driver) {
            'sqlite', 'mysql', 'pgsql' => 'varchar',
            default => 'string',
        };
        $datetime = match ($driver) {
            'mysql', 'pgsql' => 'timestamp',
            default => 'datetime',
        };

        $columns = [
            'id'           => $bigint,
            'name'         => $string,
            'guard_name'   => $string,
            'display_name' => $string,
            'description'  => $string,
            'created_at'   => $datetime,
            'updated_at'   => $datetime,
        ];

        self::assertDatabaseTable($this->tableNames['permissions'], $columns);
    }

    public function testRolesTableHasExpectedColumns(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        $bigint = match ($driver) {
            'sqlite' => 'integer',
            'pgsql'  => 'int8',
            default  => 'bigint',
        };
        $string = match ($driver) {
            'sqlite', 'mysql', 'pgsql' => 'varchar',
            default => 'string',
        };
        $datetime = match ($driver) {
            'mysql', 'pgsql' => 'timestamp',
            default => 'datetime',
        };

        $columns = [
            'id'           => $bigint,
            'name'         => $string,
            'guard_name'   => $string,
            'display_name' => $string,
            'description'  => $string,
            'created_at'   => $datetime,
            'updated_at'   => $datetime,
        ];

        self::assertDatabaseTable($this->tableNames['roles'], $columns);
    }

    public function testModelHasPermissionsTableHasExpectedColumns(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        $bigint = match ($driver) {
            'sqlite' => 'integer',
            'pgsql'  => 'int8',
            default  => 'bigint',
        };
        $string = match ($driver) {
            'sqlite', 'mysql', 'pgsql' => 'varchar',
            default => 'string',
        };

        $columns = [
            'permission_id'                       => $bigint,
            'model_type'                          => $string,
            $this->columnNames['model_morph_key'] => $bigint,
        ];

        self::assertDatabaseTable($this->tableNames['model_has_permissions'], $columns);
    }

    public function testModelHasRolesTableHasExpectedColumns(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        $bigint = match ($driver) {
            'sqlite' => 'integer',
            'pgsql'  => 'int8',
            default  => 'bigint',
        };
        $string = match ($driver) {
            'sqlite', 'mysql', 'pgsql' => 'varchar',
            default => 'string',
        };

        $columns = [
            'role_id'                             => $bigint,
            'model_type'                          => $string,
            $this->columnNames['model_morph_key'] => $bigint,
        ];

        self::assertDatabaseTable($this->tableNames['model_has_roles'], $columns);
    }

    public function testRoleHasPermissionsTableHasExpectedColumns(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        $bigint = match ($driver) {
            'sqlite' => 'integer',
            'pgsql'  => 'int8',
            default  => 'bigint',
        };

        $columns = [
            'permission_id' => $bigint,
            'role_id'       => $bigint,
        ];

        self::assertDatabaseTable($this->tableNames['role_has_permissions'], $columns);
    }

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->tableNames = config('permission.table_names');
        $this->columnNames = config('permission.column_names');
    }
}
