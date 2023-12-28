<?php

namespace App\Containers\AppSection\User\Tests\Unit\Data\Migrations;

use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversNothing]
class PasswordResetsMigrationTest extends UnitTestCase
{
    public function testPasswordResetsTableHasExpectedColumns(): void
    {
        $columns = [
            'email',
            'token',
            'created_at',
        ];

        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn('password_reset_tokens', $column));
        }
    }
}
