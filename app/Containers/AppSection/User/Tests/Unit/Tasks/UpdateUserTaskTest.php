<?php

namespace App\Containers\AppSection\User\Tests\Unit\Tasks;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\UpdateUserTask;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(UpdateUserTask::class)]
final class UpdateUserTaskTest extends UnitTestCase
{
    public function testUpdateUser(): void
    {
        $user = User::factory()->createOne();
        $data = [
            'name' => 'new name',
        ];

        $updatedUser = app(UpdateUserTask::class)->run($user->id, $data);

        $this->assertSame($user->id, $updatedUser->id);
        $this->assertSame($data['name'], $updatedUser->name);
    }

    public function testUpdatedPasswordShouldBeHashed(): void
    {
        $user = User::factory()->createOne();
        $data = [
            'password' => 'secret',
        ];

        $result = app(UpdateUserTask::class)->run($user->id, $data);

        $this->assertTrue(Hash::check($data['password'], $result->password));
    }
}
