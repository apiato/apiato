<?php

namespace App\Containers\AppSection\User\Tests\Unit\Tasks;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tasks\UpdateUserTask;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Ship\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversClass(UpdateUserTask::class)]
class UpdateUserTaskTest extends UnitTestCase
{
    public function testUpdateUser(): void
    {
        $user = UserFactory::new()->createOne();
        $data = [
            'name' => 'new name',
        ];

        $updatedUser = app(UpdateUserTask::class)->run($data, $user->id);

        $this->assertEquals($user->id, $updatedUser->id);
        $this->assertEquals($data['name'], $updatedUser->name);
    }

    public function testUpdateUserWithInvalidID(): void
    {
        $this->expectException(NotFoundException::class);

        $noneExistingId = 777777;

        app(UpdateUserTask::class)->run([], $noneExistingId);
    }

    public function testUpdatedPasswordShouldBeHashed(): void
    {
        $user = UserFactory::new()->createOne();
        $data = [
            'password' => 'secret',
        ];

        $result = app(UpdateUserTask::class)->run($data, $user->id);

        $this->assertTrue(Hash::check($data['password'], $result->password));
    }
}
