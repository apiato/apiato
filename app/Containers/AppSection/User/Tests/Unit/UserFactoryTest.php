<?php

namespace App\Containers\AppSection\User\Tests\Unit;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\TestCase;

/**
 * Class UserFactoryTest.
 *
 * @group user
 * @group unit
 */
class UserFactoryTest extends TestCase
{
    public function testCreateAdminUser(): void
    {
        $user = User::factory()->admin()->create();

        $this->assertTrue($user->is_admin);
    }

    public function testCreateUnverifiedUser(): void
    {
        $user = User::factory()->unverified()->create();

        $this->assertNull($user->email_verified_at);
    }
}
