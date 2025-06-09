<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Data\Migrations;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class MigrationTest extends UnitTestCase
{
    public function testOAuthAuthCodesTableHasExpectedColumns(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        $bigint = match ($driver) {
            'sqlite' => 'integer',
            'pgsql'  => 'int8',
            default  => 'bigint',
        };
        $char = match ($driver) {
            'mysql'  => 'char',
            'pgsql'  => 'bpchar',
            'sqlite' => 'varchar',
            default  => 'string',
        };
        $guid = match ($driver) {
            'pgsql'  => 'uuid',
            'mysql'  => 'char',
            'sqlite' => 'varchar',
            default  => 'string',
        };
        $bool = match ($driver) {
            'mysql', 'sqlite' => 'tinyint',
            default => 'bool',
        };
        $datetime = match ($driver) {
            'mysql', 'sqlite' => 'datetime',
            default => 'timestamp',
        };

        $columns = [
            'id'         => $char,
            'user_id'    => $bigint,
            'client_id'  => $guid,
            'scopes'     => 'text',
            'revoked'    => $bool,
            'expires_at' => $datetime,
        ];

        self::assertDatabaseTable('oauth_auth_codes', $columns);
    }

    public function testOAuthAccessTokenTableHasExpectedColumns(): void
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
        $char = match ($driver) {
            'mysql'  => 'char',
            'pgsql'  => 'bpchar',
            'sqlite' => 'varchar',
            default  => 'string',
        };
        $guid = match ($driver) {
            'pgsql'  => 'uuid',
            'mysql'  => 'char',
            'sqlite' => 'varchar',
            default  => 'string',
        };
        $datetime = match ($driver) {
            'mysql', 'sqlite' => 'datetime',
            default => 'timestamp',
        };
        $timestamp = match ($driver) {
            'mysql', 'pgsql' => 'timestamp',
            default => 'datetime',
        };
        $bool = match ($driver) {
            'mysql', 'sqlite' => 'tinyint',
            default => 'bool',
        };

        $columns = [
            'id'         => $char,
            'user_id'    => $bigint,
            'client_id'  => $guid,
            'name'       => $string,
            'scopes'     => 'text',
            'revoked'    => $bool,
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
            'expires_at' => $datetime,
        ];

        self::assertDatabaseTable('oauth_access_tokens', $columns);
    }

    public function testOAuthRefreshTokenTableHasExpectedColumns(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        $char = match ($driver) {
            'mysql'  => 'char',
            'pgsql'  => 'bpchar',
            'sqlite' => 'varchar',
            default  => 'string',
        };
        $bool = match ($driver) {
            'mysql', 'sqlite' => 'tinyint',
            default => 'bool',
        };
        $datetime = match ($driver) {
            'mysql', 'sqlite' => 'datetime',
            default => 'timestamp',
        };

        $columns = [
            'id'              => $char,
            'access_token_id' => $char,
            'revoked'         => $bool,
            'expires_at'      => $datetime,
        ];

        self::assertDatabaseTable('oauth_refresh_tokens', $columns);
    }

    public function testOAuthClientsTableHasExpectedColumns(): void
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
        $guid = match ($driver) {
            'pgsql'  => 'uuid',
            'mysql'  => 'char',
            'sqlite' => 'varchar',
            default  => 'string',
        };
        $bool = match ($driver) {
            'mysql', 'sqlite' => 'tinyint',
            default => 'bool',
        };
        $timestamp = match ($driver) {
            'mysql', 'pgsql' => 'timestamp',
            default => 'datetime',
        };

        $columns = [
            'id'            => $guid,
            'owner_type'    => $string,
            'owner_id'      => $bigint,
            'name'          => $string,
            'secret'        => $string,
            'provider'      => $string,
            'redirect_uris' => 'text',
            'grant_types'   => 'text',
            'revoked'       => $bool,
            'created_at'    => $timestamp,
            'updated_at'    => $timestamp,
        ];

        self::assertDatabaseTable('oauth_clients', $columns);
    }

    public function testOAuthDeviceCodesTableHasExpectedColumns(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        $bigint = match ($driver) {
            'sqlite' => 'integer',
            'pgsql'  => 'int8',
            default  => 'bigint',
        };
        $char = match ($driver) {
            'mysql'  => 'char',
            'pgsql'  => 'bpchar',
            'sqlite' => 'varchar',
            default  => 'string',
        };
        $guid = match ($driver) {
            'pgsql'  => 'uuid',
            'mysql'  => 'char',
            'sqlite' => 'varchar',
            default  => 'string',
        };
        $bool = match ($driver) {
            'mysql', 'sqlite' => 'tinyint',
            default => 'bool',
        };
        $datetime = match ($driver) {
            'pgsql' => 'timestamp',
            default => 'datetime',
        };

        $columns = [
            'id'               => $char,
            'user_id'          => $bigint,
            'client_id'        => $guid,
            'user_code'        => $char,
            'scopes'           => 'text',
            'revoked'          => $bool,
            'user_approved_at' => $datetime,
            'last_polled_at'   => $datetime,
            'expires_at'       => $datetime,
        ];

        self::assertDatabaseTable('oauth_device_codes', $columns);
    }
}
