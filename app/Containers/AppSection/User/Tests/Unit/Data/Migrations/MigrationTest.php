<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\Data\Migrations;

use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class MigrationTest extends UnitTestCase
{
    public function testUsersTableHasExpectedColumns(): void
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
            'id'                => $bigint,
            'name'              => $string,
            'email'             => $string,
            'email_verified_at' => $datetime,
            'password'          => $string,
            'gender'            => $string,
            'birth'             => 'date',
            'remember_token'    => $string,
            'created_at'        => $datetime,
            'updated_at'        => $datetime,
        ];

        $this->assertDatabaseTable('users', $columns);
    }

    public function testPasswordResetsTableHasExpectedColumns(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        $string = match ($driver) {
            'sqlite', 'mysql', 'pgsql' => 'varchar',
            default => 'string',
        };
        $datetime = match ($driver) {
            'mysql', 'pgsql' => 'timestamp',
            default => 'datetime',
        };
        $columns = [
            'email'      => $string,
            'token'      => $string,
            'created_at' => $datetime,
        ];

        $this->assertDatabaseTable('password_reset_tokens', $columns);
    }

    public function testSessionsTableHasExpectedColumns(): void
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
        $integer = match ($driver) {
            'mysql' => 'int',
            'pgsql' => 'int4',
            default => 'integer',
        };
        $text = match ($driver) {
            'mysql' => 'longtext',
            default => 'text',
        };

        $columns = [
            'id'            => $string,
            'user_id'       => $bigint,
            'ip_address'    => $string,
            'user_agent'    => 'text',
            'payload'       => $text,
            'last_activity' => $integer,
        ];

        $this->assertDatabaseTable('sessions', $columns);
    }
}
