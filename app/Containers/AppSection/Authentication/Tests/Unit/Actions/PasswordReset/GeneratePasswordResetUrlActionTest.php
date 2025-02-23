<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\PasswordReset;

use App\Containers\AppSection\Authentication\Actions\PasswordReset\GeneratePasswordResetUrlAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\PasswordReset\ResetPasswordController;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(GeneratePasswordResetUrlAction::class)]
final class GeneratePasswordResetUrlActionTest extends UnitTestCase
{
    public function testItCanGenerateCorrectUrl(): void
    {
        request()->headers->set('App-Identifier', 'my-app');
        $appUrl = 'http://localhost:3000';
        config(['apiato.apps' => [
            'my-app' => ['url' => $appUrl],
        ]]);
        $action = new GeneratePasswordResetUrlAction();
        $user = User::factory()->createOne();
        $token = 'token';
        $url = urldecode($action($user, $token));

        $apiEndpoint = action(ResetPasswordController::class);
        $this->assertStringContainsString("{$appUrl}?reset_url={$apiEndpoint}?token={$token}&email={$user->getEmailForVerification()}", $url);
    }
}
