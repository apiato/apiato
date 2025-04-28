<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Tasks;

use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(GetAuthenticatedUserTask::class)]
final class GetAuthenticatedUserTaskTest extends UnitTestCase
{
    public function testCanGetAuthenticatedUser(): void
    {
        $model = UserFactory::new()->createOne();
        auth()->setUser($model);
        $task = app(GetAuthenticatedUserTask::class);

        $foundUser = $task->run();

        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertSame($model->id, $foundUser->id);
    }

    public function testGivenUserNotAuthenticatedThrowsException(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('You are not authenticated.');

        $task = app(GetAuthenticatedUserTask::class);

        $task->run();
    }
}
