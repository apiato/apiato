<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Functional\API\PasswordReset;

use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\PasswordReset\ForgotPasswordController;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ForgotPasswordController::class)]
final class ForgotPasswordTest extends ApiTestCase
{
    public function testForgotPassword(): void
    {
        $email = 'user@admin.com';
        User::factory()->createOne([
            'email'    => $email,
            'password' => 'youShallNotPass',
        ]);

        $data = [
            'email' => $email,
        ];

        $response = $this->postJson(action(ForgotPasswordController::class), $data);

        $response->assertAccepted();
    }
}
