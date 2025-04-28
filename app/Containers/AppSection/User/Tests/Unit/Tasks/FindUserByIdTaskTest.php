<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\Tasks;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(FindUserByIdTask::class)]
final class FindUserByIdTaskTest extends UnitTestCase
{
    public function testFindUserById(): void
    {
        $model = UserFactory::new()->createOne();
        $repositoryMock = $this->partialMock(UserRepository::class);
        $repositoryMock->expects('getById')->once()->with($model->id)->andReturn($model);

        app(FindUserByIdTask::class)->run($model->id);
    }
}
