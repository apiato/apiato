<?php

namespace App\Containers\AppSection\User\Tests\Unit;

use App\Containers\AppSection\User\Actions\ResetPasswordAction;
use App\Containers\AppSection\User\Exceptions\InvalidResetPasswordTokenException;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\CreatePasswordResetTask;
use App\Containers\AppSection\User\Tests\TestCase;
use App\Containers\AppSection\User\UI\API\Requests\ResetPasswordRequest;
use App\Ship\Exceptions\NotFoundException;

/**
 * Class ResetPasswordActionTest.
 *
 * @group user
 * @group unit
 */
class ResetPasswordActionTest extends TestCase
{
    private User $user;

    public function testResetPasswordWithInvalidToken_ThrowsException(): void
    {
        $this->expectException(InvalidResetPasswordTokenException::class);
        $this->expectExceptionMessage('Invalid Reset Password Token Provided.');

        $data = [
            'email' => $this->user->email,
            'password' => 'new pass',
            'token' => 'invalid token',
        ];

        $request = new ResetPasswordRequest($data);
        app(ResetPasswordAction::class)->run($request);
    }

    public function testResetPasswordWithInvalidEmail_ThrowsException(): void
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('User Not Found.');

        $token = app(CreatePasswordResetTask::class)->run($this->user);

        $data = [
            'email' => 'someone@elses.mail',
            'password' => 'new pass',
            'token' => $token,
        ];

        $request = new ResetPasswordRequest($data);
        app(ResetPasswordAction::class)->run($request);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'email' => 'someone@something.test',
            'password' => 'old pass',
        ]);
    }
}
