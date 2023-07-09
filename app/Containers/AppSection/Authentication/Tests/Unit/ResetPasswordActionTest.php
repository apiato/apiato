<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Actions\ResetPasswordAction;
use App\Containers\AppSection\Authentication\Exceptions\InvalidResetPasswordTokenException;
use App\Containers\AppSection\Authentication\Notifications\PasswordReset;
use App\Containers\AppSection\Authentication\Tasks\CreatePasswordResetTokenTask;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\ResetPasswordRequest;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Notification;

/**
 * @group authentication
 * @group unit
 */
class ResetPasswordActionTest extends UnitTestCase
{
    private User $user;

    public function testResetPassword(): void
    {
        Notification::fake();
        $token = app(CreatePasswordResetTokenTask::class)->run($this->user);
        $data = [
            'email' => $this->user->email,
            'token' => $token,
            'password' => 'new pass',
            'password_confirmation' => 'new pass',
        ];
        $request = new ResetPasswordRequest($data);

        app(ResetPasswordAction::class)->run($request);

        Notification::assertSentTo($this->user, PasswordReset::class);
    }

    public function testResetPasswordWithInvalidTokenThrowsException(): void
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

    public function testResetPasswordWithInvalidEmailThrowsException(): void
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('User Not Found.');

        $token = app(CreatePasswordResetTokenTask::class)->run($this->user);

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
