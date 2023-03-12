<?php

namespace App\Containers\AppSection\User\Tests\Unit;

use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Support\Facades\Schema;

/**
 * Class PasswordResetsMigrationTest.
 *
 * @group user
 * @group unit
 */
class PasswordResetsMigrationTest extends UnitTestCase
{
    public function test_password_resets_table_has_expected_columns(): void
    {
        $columns = [
            'email',
            'token',
            'created_at',
        ];

        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn('password_resets', $column));
        }
    }
}
