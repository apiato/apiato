<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API\PasswordReset;

use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\PasswordReset\ResetPasswordController;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Password;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ResetPasswordController::class)]
final class ResetPasswordTest extends ApiTestCase
{
    public function testResetPassword(): void
    {
        $user = User::factory()->createOne([
            'email' => 'ganldalf@the.grey',
            'password' => 'youShallNotPass',
        ]);
        $data = [
            'email' => $user->email,
            'password' => 's3cr3tPa$$',
            'password_confirmation' => 's3cr3tPa$$',
            'token' => Password::createToken($user),
        ];

        $response = $this->postJson(action(ResetPasswordController::class), $data);

        $response->assertOk();
    }
}
