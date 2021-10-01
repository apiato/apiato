<?php

namespace App\Containers\AppSection\User\Tests\Unit;

use App\Containers\AppSection\User\Tasks\CreateUserByCredentialsTask;
use App\Containers\AppSection\User\Tests\TestCase;
use App\Ship\Exceptions\CreateResourceFailedException;

/**
 * Class CreateUserByCredentialsTaskTest.
 *
 * @group user
 * @group unit
 */
class CreateUserByCredentialsTaskTest extends TestCase
{
    public function testCreateUserByCredentials(): void
    {
        $data = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
        ];

        $user = app(CreateUserByCredentialsTask::class)->run($data);

        $this->assertModelExists($user);
    }

    public function testCreateUserWithoutEmail(): void
    {
        $this->expectException(CreateResourceFailedException::class);
        $this->expectExceptionMessage('Email field is required');

        $data = [
            'password' => 'so-secret',
            'name' => 'Mahmoud',
        ];

        app(CreateUserByCredentialsTask::class)->run($data);
    }

    public function testCreateUserWithoutPassword(): void
    {
        $this->expectException(CreateResourceFailedException::class);
        $this->expectExceptionMessage('Password field is required');

        $data = [
            'email' => 'Mahmoud@test.test',
            'name' => 'Mahmoud',
        ];

        app(CreateUserByCredentialsTask::class)->run($data);
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

        app(CreateUserByCredentialsTask::class)->run($data);
    }
}
