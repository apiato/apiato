<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\PasswordReset;

use App\Containers\AppSection\Authentication\Actions\PasswordReset\ForgotPasswordAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\PasswordReset\ForgotPasswordRequest;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ForgotPasswordAction::class)]
final class ForgotPasswordActionTest extends UnitTestCase
{
    public function testCanSendResetLink(): void
    {
        $user = User::factory()->createOne();
        $data = [
            'email' => $user->email,
        ];

        $forgotPasswordRequest = new ForgotPasswordRequest($data);
        $result = app(ForgotPasswordAction::class)->run($forgotPasswordRequest);

        self::assertSame(__(Password::RESET_LINK_SENT), $result);
    }

    public function testPassingInvalidDataThrowsException(): void
    {
        $this->expectExceptionObject(
            ValidationException::withMessages([
                'email' => __(Password::INVALID_USER),
            ]),
        );

        $data = [
            'email' => 'non@existing.user',
        ];
        $forgotPasswordRequest = new ForgotPasswordRequest($data);

        app(ForgotPasswordAction::class)->run($forgotPasswordRequest);
    }

    public function testItPreventsTooManyRequests(): void
    {
        $this->expectExceptionObject(
            ValidationException::withMessages([
                'throttle' => __(Password::RESET_THROTTLED),
            ]),
        );

        $data = [
            'email' => User::factory()->createOne()->email,
        ];
        $forgotPasswordRequest = new ForgotPasswordRequest($data);
        $action = app(ForgotPasswordAction::class);

        $action->run($forgotPasswordRequest);
        $action->run($forgotPasswordRequest);
    }
}
