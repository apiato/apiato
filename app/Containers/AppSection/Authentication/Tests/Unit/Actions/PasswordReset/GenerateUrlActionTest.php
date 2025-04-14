<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\PasswordReset;

use App\Containers\AppSection\Authentication\Actions\PasswordReset\GenerateUrlAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\PasswordReset\ResetPasswordController;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Apps\AppFactory;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(GenerateUrlAction::class)]
final class GenerateUrlActionTest extends UnitTestCase
{
    public function testItCanGenerateCorrectUrl(): void
    {
        request()->headers->set('App-Identifier', 'web');
        $action = new GenerateUrlAction();
        $user = User::factory()->createOne();
        $token = 'token';
        $url = urldecode($action($user, $token));

        $apiEndpoint = action(ResetPasswordController::class);

        $this->assertStringContainsString(AppFactory::current()->resetPasswordUrl() . "?reset_url={$apiEndpoint}?token={$token}&email={$user->getEmailForVerification()}", $url);
    }
}
