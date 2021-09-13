<?php

namespace App\Containers\AppSection\User\Tests\Unit;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\UpdateUserTask;
use App\Containers\AppSection\User\Tests\TestCase;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use Illuminate\Support\Facades\Hash;

/**
 * Class UpdateUserTaskTest.
 *
 * @group user
 * @group unit
 */
class UpdateUserTaskTest extends TestCase
{
    public function testUpdateUserWithoutData(): void
    {
        $this->expectException(UpdateResourceFailedException::class);
        $this->expectExceptionMessage('Inputs are empty.');

        app(UpdateUserTask::class)->run([], null);
    }

    public function testUpdateUserWithInvalidID(): void
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('User Not Found.');

        $data = [
            'password' => 'secret',
        ];

        app(UpdateUserTask::class)->run($data, 'wrong-id');
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
