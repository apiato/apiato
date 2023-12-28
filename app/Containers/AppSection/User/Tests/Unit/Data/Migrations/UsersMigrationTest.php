<?php

namespace App\Containers\AppSection\User\Tests\Unit\Data\Migrations;

use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversNothing]
class UsersMigrationTest extends UnitTestCase
{
    public function testUsersTableHasExpectedColumns(): void
    {
        $columns = [
            'id',
            'name',
            'email',
            'password',
            'email_verified_at',
            'gender',
            'remember_token',
            'created_at',
            'updated_at',
        ];

        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn('users', $column));
        }
    }
}
