<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Tasks\CreateUserByCredentialsTask;
use App\Containers\AppSection\Authentication\Tests\TestCase;
use App\Ship\Exceptions\CreateResourceFailedException;

/**
 * Class CreateUserByCredentialsTaskTest.
 *
 * @group authentication
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
