<?php

namespace App\Containers\AppSection\User\Tests\Unit\Policies;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Policies\UserPolicy;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversClass(UserPolicy::class)]
final class UserPolicyTest extends UnitTestCase
{
    public function testCanDeleteUserOnlyIfAdmin(): void
    {
        $policy = app(UserPolicy::class);

        $this->assertFalse($policy->delete());
    }

    public function testCanShowUserOnlyIfAdmin(): void
    {
        $policy = app(UserPolicy::class);

        $this->assertFalse($policy->show());
    }

    public function testCanIndexUsersOnlyIfAdmin(): void
    {
        $policy = app(UserPolicy::class);

        $this->assertFalse($policy->index());
    }

    public function testCanUpdateUserAsOwner(): void
    {
        $policy = app(UserPolicy::class);
        $user = UserFactory::new()->createOne();

        $this->assertTrue($policy->update($user, $user->id));
    }
}
