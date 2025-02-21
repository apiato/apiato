<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\PasswordReset;

use App\Containers\AppSection\Authentication\Actions\PasswordReset\ResetPasswordAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\PasswordReset\ResetPasswordRequest;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(ResetPasswordAction::class)]
final class ResetPasswordActionTest extends UnitTestCase
{
    public static function invalidDataProvider(): array
    {
        return [
            [
                [
                    'token' => static fn () => 'invalid token',
                    'email' => fn () => User::factory()->createOne()->email,
                ],
                'token',
                Password::INVALID_TOKEN,
            ],
            [
                [
                    'token' => fn () => Password::createToken(User::factory()->createOne()),
                    'email' => 'invalid email',
                ],
                'token',
                Password::INVALID_USER,
            ],
        ];
    }

    public function testCanResetPassword(): void
    {
        Event::fake();
        $user = User::factory()->createOne([
            'email' => 'ganldalf@the.grey',
            'password' => 'youShallNotPass',
        ]);
        $data = [
            'email' => $user->email,
            'token' => Password::createToken($user),
            'password' => 'new pass',
            'password_confirmation' => 'new pass',
        ];
        $request = new ResetPasswordRequest($data);

        $result = app(ResetPasswordAction::class)->run($request);

        $this->assertSame(__(Password::PASSWORD_RESET), $result);
        $this->assertTrue(Hash::check($data['password'], $user->fresh()->password));
        Event::assertDispatched(
            PasswordReset::class,
            static function (PasswordReset $event) use ($user) {
                return $event->user->is($user);
            },
        );
    }

    #[DataProvider('invalidDataProvider')]
    public function testPassingInvalidDataThrowsException(array $data, string $key, string $message): void
    {
        $this->expectExceptionObject(
            ValidationException::withMessages([
                $key => __($message)]),
        );

        $request = new ResetPasswordRequest($data);

        app(ResetPasswordAction::class)->run($request);
    }
}
