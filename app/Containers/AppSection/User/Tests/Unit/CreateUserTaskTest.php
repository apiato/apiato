<?php

namespace App\Containers\AppSection\User\Tests\Unit;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\CreateUserTask;
use App\Ship\Exceptions\CreateResourceFailedException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @group authentication
 * @group unit
 */
class CreateUserTaskTest extends UnitTestCase
{
    public function testCreateUser(): void
    {
        $data = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
        ];

        $user = app(CreateUserTask::class)->run($data);

        $this->assertModelExists($user);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(Str::lower($data['email']), $user->email);
        $this->assertTrue(Hash::check($data['password'], $user->password));
    }

    public function testCreateUserWithInvalidData(): void
    {
        $this->expectException(CreateResourceFailedException::class);
        $this->expectExceptionMessage('Failed to create Resource.');

        $data = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
            'birth' => 'wrong-format',
        ];

        app(CreateUserTask::class)->run($data);
    }
}
