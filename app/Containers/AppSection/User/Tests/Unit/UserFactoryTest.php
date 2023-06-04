<?php

namespace App\Containers\AppSection\User\Tests\Unit;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\UnitTestCase;

/**
 * @group user
 * @group unit
 */
class UserFactoryTest extends UnitTestCase
{
    public function testCreateUser(): void
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(User::class, $user);
    }

    public function testCreateAdminUser(): void
    {
        $user = User::factory()->admin()->create();

        $this->assertTrue($user->hasRole(config('appSection-authorization.admin_role')));
    }

    public function testCreateUnverifiedUser(): void
    {
        $user = User::factory()->unverified()->create();

        $this->assertNull($user->email_verified_at);
    }
}
