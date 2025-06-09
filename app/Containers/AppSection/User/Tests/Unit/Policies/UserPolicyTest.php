<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\Policies;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Policies\UserPolicy;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(UserPolicy::class)]
final class UserPolicyTest extends UnitTestCase
{
    public function testCanDeleteUserOnlyIfAdmin(): void
    {
        $policy = app(UserPolicy::class);

        self::assertFalse($policy->delete());
    }

    public function testCanShowUserOnlyIfAdmin(): void
    {
        $policy = app(UserPolicy::class);
        $user = User::factory()->createOne();

        self::assertTrue($policy->show($user, $user->id));
    }

    public function testCanIndexUsersOnlyIfAdmin(): void
    {
        $policy = app(UserPolicy::class);

        self::assertFalse($policy->index());
    }

    public function testCanUpdateUserAsOwner(): void
    {
        $policy = app(UserPolicy::class);
        $user = User::factory()->createOne();

        self::assertTrue($policy->update($user, $user->id));
    }
}
