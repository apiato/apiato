<?php

namespace App\Containers\AppSection\User\Tests\Unit;

use App\Containers\AppSection\User\Actions\RegisterUserAction;
use App\Containers\AppSection\User\Tests\TestCase;
use App\Containers\AppSection\User\UI\API\Requests\RegisterUserRequest;
use App\Ship\Exceptions\CreateResourceFailedException;

/**
 * Class CreateUserByCredentialsTaskTest.
 *
 * @group user
 * @group unit
 */
class CreateUserByCredentialsTaskTest extends TestCase
{

    public function testCreateUserWithoutEmail(): void
    {
        $this->expectException(CreateResourceFailedException::class);
        $this->expectExceptionMessage('Email field is required');

        $data = [
            'password' => 'so-secret',
            'name' => 'Mahmoud',
        ];

        $request = new RegisterUserRequest($data);
        app(RegisterUserAction::class)->run($request);
    }

    public function testCreateUserWithoutPassword(): void
    {
        $this->expectException(CreateResourceFailedException::class);
        $this->expectExceptionMessage('Password field is required');

        $data = [
            'email' => 'Mahmoud@test.test',
            'name' => 'Mahmoud',
        ];

        $request = new RegisterUserRequest($data);
        app(RegisterUserAction::class)->run($request);
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

        $request = new RegisterUserRequest($data);
        app(RegisterUserAction::class)->run($request);
    }
}
