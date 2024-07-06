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
            'queue' => 'varchar',
            'payload' => 'longtext',
            'attempts' => 'tinyint',
            'reserved_at' => 'int',
            'available_at' => 'int',
            'created_at' => 'int',
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
            'payload' => 'longtext',
            'exception' => 'longtext',
            'failed_at' => 'timestamp',
            'uuid' => 'varchar',
        ];

        $this->assertDatabaseTable($table, $columns);
    }

    public function testNotificationsTableHasExpectedColumns(): void
    {
        $table = 'notifications';
        
        $columns = [
            'id' => 'char',
            'type' => 'varchar',
            'notifiable_id' => 'bigint',
            'notifiable_type' => 'varchar',
            'data' => 'text',
            'read_at' => 'timestamp',
            'created_at' => 'timestamp',
            'updated_at' => 'timestamp',
        ];

        $this->assertDatabaseTable($table, $columns);
    }
}
