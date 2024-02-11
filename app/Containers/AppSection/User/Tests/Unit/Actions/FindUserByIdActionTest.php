<?php

namespace App\Containers\AppSection\User\Tests\Unit\Actions;

use App\Containers\AppSection\User\Actions\FindUserByIdAction;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Data\Resources\UserResource;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversClass(FindUserByIdAction::class)]
final class FindUserByIdActionTest extends UnitTestCase
{
    public function testCanDeleteUser(): void
    {
        $user = UserFactory::new()->createOne();
        $userData = UserResource::from(['id' => $user->id]);
        $action = app(FindUserByIdAction::class);

        $result = $action->run($userData);

        $this->assertSame($user->id, $result->id);
    }
}
