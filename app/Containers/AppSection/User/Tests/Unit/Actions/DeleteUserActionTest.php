<?php

namespace App\Containers\AppSection\User\Tests\Unit\Actions;

use App\Containers\AppSection\User\Actions\DeleteUserAction;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Containers\AppSection\User\UI\API\Requests\DeleteUserRequest;
use App\Ship\Exceptions\NotFoundException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversClass(DeleteUserAction::class)]
final class DeleteUserActionTest extends UnitTestCase
{
    public function testCanDeleteUser(): void
    {
        $user = UserFactory::new()->createOne();
        $request = DeleteUserRequest::injectData()->withUrlParameters(['id' => $user->id]);
        $action = app(DeleteUserAction::class);

        $action->run($request);

        $this->assertModelMissing($user);
    }

    public function testGivenNoUserFoundShouldThrow404(): void
    {
        $this->expectException(NotFoundException::class);

        $nonExistingID = 7777777;
        $request = DeleteUserRequest::injectData()->withUrlParameters(['id' => $nonExistingID]);
        $action = app(DeleteUserAction::class);

        $action->run($request);
    }
}
