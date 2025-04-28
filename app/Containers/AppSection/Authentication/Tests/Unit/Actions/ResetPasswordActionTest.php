<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\ResetPasswordAction;
use App\Containers\AppSection\Authentication\Exceptions\InvalidResetPasswordTokenException;
use App\Containers\AppSection\Authentication\Notifications\PasswordReset;
use App\Containers\AppSection\Authentication\Tasks\CreatePasswordResetTokenTask;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\ResetPasswordRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ResetPasswordAction::class)]
final class ResetPasswordActionTest extends UnitTestCase
{
    private User $user;

    public function testCanResetPassword(): void
    {
        Notification::fake();
        $token = app(CreatePasswordResetTokenTask::class)->run($this->user);
        $data = [
            'email'                 => $this->user->email,
            'token'                 => $token,
            'password'              => 'new pass',
            'password_confirmation' => 'new pass',
        ];
        $resetPasswordRequest = new ResetPasswordRequest($data);

        app(ResetPasswordAction::class)->run($resetPasswordRequest);

        $this->assertTrue(Hash::check($data['password'], $this->user->fresh()->password));
        Notification::assertSentTo($this->user, PasswordReset::class);
    }

    public function testResetPasswordWithInvalidTokenThrowsException(): void
    {
        $this->expectException(InvalidResetPasswordTokenException::class);
        $this->expectExceptionMessage('Invalid Reset Password Token Provided.');

        $data = [
            'email'    => $this->user->email,
            'password' => 'new pass',
            'token'    => 'invalid token',
        ];
        $resetPasswordRequest = new ResetPasswordRequest($data);

        app(ResetPasswordAction::class)->run($resetPasswordRequest);
    }

    public function testResetPasswordWithInvalidEmailThrowsException(): void
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('User Not Found.');

        $token = app(CreatePasswordResetTokenTask::class)->run($this->user);
        $data = [
            'email'    => 'ganldalf@the.white',
            'password' => 'youShallNotPass',
            'token'    => $token,
        ];
        $resetPasswordRequest = new ResetPasswordRequest($data);

        app(ResetPasswordAction::class)->run($resetPasswordRequest);
    }

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->createOne([
            'email'    => 'ganldalf@the.grey',
            'password' => 'youShallNotPass',
        ]);
    }
}
