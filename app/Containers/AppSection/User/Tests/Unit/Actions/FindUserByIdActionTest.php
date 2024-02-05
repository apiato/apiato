<?php

namespace App\Containers\AppSection\User\Tests\Unit\Actions;

use App\Containers\AppSection\User\Actions\FindUserByIdAction;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Containers\AppSection\User\UI\API\Requests\FindUserByIdRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversClass(FindUserByIdAction::class)]
final class FindUserByIdActionTest extends UnitTestCase
{
    public function testCanDeleteUser(): void
    {
        $user = UserFactory::new()->createOne();
        $request = FindUserByIdRequest::injectData()->withUrlParameters(['id' => $user->id]);
        $action = app(FindUserByIdAction::class);

        $result = $action->run($request);

        $this->assertSame($user->id, $result->id);
    }
}
