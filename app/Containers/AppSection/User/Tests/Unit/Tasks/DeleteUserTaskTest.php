<?php

namespace App\Containers\AppSection\User\Tests\Unit\Tasks;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tasks\DeleteUserTask;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Ship\Exceptions\NotFoundException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversClass(DeleteUserTask::class)]
class DeleteUserTaskTest extends UnitTestCase
{
    public function testDeleteUser(): void
    {
        $user = UserFactory::new()->createOne();

        $result = app(DeleteUserTask::class)->run($user->id);

        $this->assertEquals(1, $result);
    }

    public function testDeleteUserWithInvalidId(): void
    {
        $this->expectException(NotFoundException::class);

        $noneExistingId = 777777;

        app(DeleteUserTask::class)->run($noneExistingId);
    }
}
