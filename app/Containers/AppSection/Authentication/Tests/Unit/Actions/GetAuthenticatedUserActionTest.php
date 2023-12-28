<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\GetAuthenticatedUserAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
class GetAuthenticatedUserActionTest extends UnitTestCase
{
    public function testGetAuthenticatedUserAction(): void
    {
        $user = UserFactory::new()->createOne();
        auth()->setUser($user);

        $action = app(GetAuthenticatedUserAction::class);

        $foundUser = $action->run();

        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals($user->id, $foundUser->id);
    }
}
