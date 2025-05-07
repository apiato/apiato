<?php

namespace App\Containers\AppSection\User\Tests\Unit\Actions;

use App\Containers\AppSection\User\Actions\DeleteUserAction;
use App\Containers\AppSection\User\Exceptions\FailedToDeleteUser;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(DeleteUserAction::class)]
final class DeleteUserActionTest extends UnitTestCase
{
    public function testCanDeleteAnotherUser(): void
    {
        $user = User::factory()->createOne();
        $this->actingAs($user, 'api');
        $anotherUser = User::factory()->createOne();

        $action = app(DeleteUserAction::class);

        $result = $action->run($anotherUser->id);

        $this->assertTrue($result);
        $this->assertModelMissing($anotherUser);
    }

    public function testCannotDeleteItself(): void
    {
        $this->expectException(FailedToDeleteUser::class);

        $user = User::factory()->createOne();
        $this->actingAs($user, 'api');
        $action = app(DeleteUserAction::class);

        $action->run($user->id);
    }
}
