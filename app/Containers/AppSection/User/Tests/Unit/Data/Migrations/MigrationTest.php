<?php

namespace App\Containers\AppSection\User\Tests\Unit\Data\Migrations;

use App\Containers\AppSection\User\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversNothing]
final class MigrationTest extends UnitTestCase
{
    public function testUsersTableHasExpectedColumns(): void
    {
        $columns = [
            'id' => 'bigint',
            'name' => 'string',
            'email' => 'string',
            'email_verified_at' => 'datetime',
            'password' => 'string',
            'gender' => 'string',
            'birth' => 'date',
            'remember_token' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];

        $this->assertDatabaseTable('users', $columns);
    }

    public function testPasswordResetsTableHasExpectedColumns(): void
    {
        $columns = [
            'email' => 'string',
            'token' => 'string',
            'created_at' => 'datetime',
        ];

        $this->assertDatabaseTable('password_reset_tokens', $columns);
    }
}
