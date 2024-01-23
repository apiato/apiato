<?php

namespace App\Containers\AppSection\User\Tests\Unit\Tasks;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;
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
            'name' => 'new name',
        ];

        $updatedUser = app(UpdateUserTask::class)->run($user->id, $data);

        $this->assertSame($user->id, $updatedUser->id);
        $this->assertSame($data['name'], $updatedUser->name);
    }

    public function testUpdateUserWithUpdateResourceFailedException(): void
    {
        $this->expectException(UpdateResourceFailedException::class);

        $user = UserFactory::new()->createOne();
        $data = [
            'name' => 'new name',
        ];
        $this->mock(UserRepository::class);
        app(UpdateUserTask::class)->run($data, $user->id);
    }

    public function testUpdateUserWithInvalidID(): void
    {
        $this->expectException(NotFoundException::class);

        $noneExistingId = 7777777;

        app(UpdateUserTask::class)->run($noneExistingId, []);
    }

    public function testUpdatedPasswordShouldBeHashed(): void
    {
        $user = UserFactory::new()->createOne();
        $data = [
            'password' => 'secret',
        ];

        $result = app(UpdateUserTask::class)->run($user->id, $data);

        $this->assertTrue(Hash::check($data['password'], $result->password));
    }
}
