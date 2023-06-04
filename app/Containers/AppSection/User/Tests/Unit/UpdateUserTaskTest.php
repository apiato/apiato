<?php

namespace App\Containers\AppSection\User\Tests\Unit;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\UpdateUserTask;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Ship\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Hash;

/**
 * @group user
 * @group unit
 */
class UpdateUserTaskTest extends UnitTestCase
{
    public function testUpdateUser(): void
    {
        $user = User::factory()->create();
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
        $user = User::factory()->create();
        $data = [
            'password' => 'secret',
        ];

        $result = app(UpdateUserTask::class)->run($data, $user->id);

        $this->assertTrue(Hash::check($data['password'], $result->password));
    }
}
