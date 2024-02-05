<?php

namespace App\Ship\Tests\Unit\Migrations;

use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversNothing]
final class ShipMigrationTest extends ShipTestCase
{
    public function testJobsTableHasExpectedColumns(): void
    {
        $table = 'jobs';
        $columns = [
            'id' => 'bigint',
            'queue' => 'string',
            'payload' => 'text',
            'attempts' => 'smallint',
            'reserved_at' => 'integer',
            'available_at' => 'integer',
            'created_at' => 'integer',
        ];

        $this->assertDatabaseTable($table, $columns);
    }

    public function testFailedJobsTableHasExpectedColumns(): void
    {
        $table = 'failed_jobs';
        $columns = [
            'id' => 'bigint',
            'connection' => 'text',
            'queue' => 'text',
            'payload' => 'text',
            'exception' => 'text',
            'failed_at' => 'datetime',
            'uuid' => 'string',
        ];

        $this->assertDatabaseTable($table, $columns);
    }

    public function testNotificationsTableHasExpectedColumns(): void
    {
        $table = 'notifications';
        $columns = [
            'id' => 'guid',
            'type' => 'string',
            'notifiable_id' => 'bigint',
            'notifiable_type' => 'string',
            'data' => 'text',
            'read_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];

        $this->assertDatabaseTable($table, $columns);
    }
}
