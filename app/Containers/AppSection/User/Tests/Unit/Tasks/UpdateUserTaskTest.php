<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\Tasks;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\Tasks\UpdateUserTask;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(UpdateUserTask::class)]
final class UpdateUserTaskTest extends UnitTestCase
{
    public function testUpdateUser(): void
    {
        $model = UserFactory::new()->createOne();
        $data = [
            'name' => 'new name',
        ];

        $updatedUser = app(UpdateUserTask::class)->run($model->id, $data);

        $this->assertSame($model->id, $updatedUser->id);
        $this->assertSame($data['name'], $updatedUser->name);
    }

    public function testUpdateUserWithInvalidID(): void
    {
        $this->expectException(NotFoundException::class);

        $noneExistingId = 7777777;

        app(UpdateUserTask::class)->run($noneExistingId, []);
    }

    public function testUpdatedPasswordShouldBeHashed(): void
    {
        $model = UserFactory::new()->createOne();
        $data = [
            'password' => 'secret',
        ];

        $result = app(UpdateUserTask::class)->run($model->id, $data);

        $this->assertTrue(Hash::check($data['password'], $result->password));
    }

    public function testCatchesAllExceptionsAndThrowsCustomException(): void
    {
        $this->expectException(UpdateResourceFailedException::class);

        $model = UserFactory::new()->createOne();
        $this->partialMock(UserRepository::class)
            ->expects('update')->andThrowExceptions([
                new \Exception(),
            ]);

        app(UpdateUserTask::class)->run($model->id, []);
    }
}
