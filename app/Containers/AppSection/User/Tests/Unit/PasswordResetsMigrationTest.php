<?php

namespace App\Containers\AppSection\User\Tests\Unit;

use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Support\Facades\Schema;

/**
 * @group user
 * @group unit
 */
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
