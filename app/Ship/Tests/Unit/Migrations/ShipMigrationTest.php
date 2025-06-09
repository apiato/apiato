<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Migrations;

use App\Ship\Tests\ShipTestCase;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class ShipMigrationTest extends ShipTestCase
{
    public function testCacheTableHasExpectedColumns(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        $integer = match ($driver) {
            'mysql' => 'int',
            'pgsql' => 'int4',
            default => 'integer',
        };
        $string = match ($driver) {
            'sqlite', 'mysql', 'pgsql' => 'varchar',
            default => 'string',
        };
        $text = match ($driver) {
            'mysql' => 'mediumtext',
            default => 'text',
        };

        $columns = [
            'key'        => $string,
            'value'      => $text,
            'expiration' => $integer,
        ];

        self::assertDatabaseTable('cache', $columns);
    }

    public function testCacheLocksTableHasExpectedColumns(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        $integer = match ($driver) {
            'mysql' => 'int',
            'pgsql' => 'int4',
            default => 'integer',
        };
        $string = match ($driver) {
            'sqlite', 'mysql', 'pgsql' => 'varchar',
            default => 'string',
        };

        $columns = [
            'key'        => $string,
            'owner'      => $string,
            'expiration' => $integer,
        ];

        self::assertDatabaseTable('cache_locks', $columns);
    }

    public function testJobsTableHasExpectedColumns(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        $bigint = match ($driver) {
            'sqlite' => 'integer',
            'pgsql'  => 'int8',
            default  => 'bigint',
        };
        $integer = match ($driver) {
            'mysql' => 'int',
            'pgsql' => 'int4',
            default => 'integer',
        };
        $smallint = match ($driver) {
            'mysql'  => 'tinyint',
            'pgsql'  => 'int2',
            'sqlite' => 'integer',
            default  => 'smallint',
        };
        $string = match ($driver) {
            'sqlite', 'mysql', 'pgsql' => 'varchar',
            default => 'string',
        };
        $text = match ($driver) {
            'mysql' => 'longtext',
            default => 'text',
        };

        $columns = [
            'id'           => $bigint,
            'queue'        => $string,
            'payload'      => $text,
            'attempts'     => $smallint,
            'reserved_at'  => $integer,
            'available_at' => $integer,
            'created_at'   => $integer,
        ];

        self::assertDatabaseTable('jobs', $columns);
    }

    public function testJobBatchesTableHasExpectedColumns(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        $integer = match ($driver) {
            'mysql' => 'int',
            'pgsql' => 'int4',
            default => 'integer',
        };
        $string = match ($driver) {
            'sqlite', 'mysql', 'pgsql' => 'varchar',
            default => 'string',
        };
        $text = match ($driver) {
            'mysql' => 'mediumtext',
            default => 'text',
        };
        $longtext = match ($driver) {
            'mysql' => 'longtext',
            default => 'text',
        };

        $columns = [
            'id'             => $string,
            'name'           => $string,
            'total_jobs'     => $integer,
            'pending_jobs'   => $integer,
            'failed_jobs'    => $integer,
            'failed_job_ids' => $longtext,
            'options'        => $text,
            'cancelled_at'   => $integer,
            'created_at'     => $integer,
            'finished_at'    => $integer,
        ];

        self::assertDatabaseTable('job_batches', $columns);
    }

    public function testFailedJobsTableHasExpectedColumns(): void
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
        $text = match ($driver) {
            'mysql' => 'longtext',
            default => 'text',
        };

        $columns = [
            'id'         => $bigint,
            'connection' => 'text',
            'queue'      => 'text',
            'payload'    => $text,
            'exception'  => $text,
            'failed_at'  => $datetime,
            'uuid'       => $string,
        ];

        self::assertDatabaseTable('failed_jobs', $columns);
    }

    public function testNotificationsTableHasExpectedColumns(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        $guid = match ($driver) {
            'pgsql'  => 'uuid',
            'mysql'  => 'char',
            'sqlite' => 'varchar',
            default  => 'string',
        };
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
            'id'              => $guid,
            'type'            => $string,
            'notifiable_id'   => $bigint,
            'notifiable_type' => $string,
            'data'            => 'text',
            'read_at'         => $datetime,
            'created_at'      => $datetime,
            'updated_at'      => $datetime,
        ];

        self::assertDatabaseTable('notifications', $columns);
    }
}
