<?php

namespace App\Containers\AppSection\User\Tests\Unit\Tasks;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\Data\Resources\UserResource;
use App\Containers\AppSection\User\Tasks\UpdateUserTask;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversClass(UpdateUserTask::class)]
final class UpdateUserTaskTest extends UnitTestCase
{
    public function testUpdateUser(): void
    {
        $user = UserFactory::new()->createOne();
        $data = [
            'id' => $user->id,
            'name' => 'new name',
        ];
        $userData = UserResource::from($data);

        $updatedUser = app(UpdateUserTask::class)->run($userData);

        $this->assertSame($user->id, $updatedUser->id);
        $this->assertSame($data['name'], $updatedUser->name);
    }

    public function testUpdateUserWithInvalidID(): void
    {
        $this->expectException(NotFoundException::class);

        $noneExistingId = 7777777;
        $userData = UserResource::from(['id' => $noneExistingId]);

        app(UpdateUserTask::class)->run($userData);
    }

    public function testUpdatedPasswordShouldBeHashed(): void
    {
        $user = UserFactory::new()->createOne();
        $data = [
            'id' => $user->id,
            'password' => 'secret',
        ];
        $userData = UserResource::from($data);

        $result = app(UpdateUserTask::class)->run($userData);

        $this->assertTrue(Hash::check($data['password'], $result->password));
    }

    public function testCatchesAllExceptionsAndThrowsCustomException(): void
    {
        $this->expectException(UpdateResourceFailedException::class);

        $this->partialMock(UserRepository::class)
            ->expects('update')->andThrowExceptions([
                new \Exception(),
            ]);

        app(UpdateUserTask::class)->run(UserResource::from());
    }
}
