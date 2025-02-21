<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API\PasswordReset;

use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\PasswordReset\ForgotPasswordController;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ForgotPasswordController::class)]
final class ForgotPasswordTest extends ApiTestCase
{
    public function testForgotPassword(): void
    {
        $data = [
            'email' => 'admin@admin.com',
        ];

        $response = $this->postJson(action(ForgotPasswordController::class), $data);

        $response->assertAccepted();
    }
}
