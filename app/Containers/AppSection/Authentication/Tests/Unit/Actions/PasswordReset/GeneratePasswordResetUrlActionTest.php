<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\PasswordReset;

use App\Containers\AppSection\Authentication\Actions\PasswordReset\GeneratePasswordResetUrlAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\PasswordReset\ResetPasswordController;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(GeneratePasswordResetUrlAction::class)]
final class GeneratePasswordResetUrlActionTest extends UnitTestCase
{
    #[DataProvider('clientDataProvider')]
    public function testItCanGenerateCorrectUrl(string $clientType, string $frontendUrl): void
    {
        request()->headers->set('Client-Type', $clientType);
        config(['apiato.frontend.urls' => [
            'web' => 'http://localhost:3000',
            'desktop' => 'http://localhost:5000',
            'mobile' => 'http://localhost:4000',
        ]]);
        $action = new GeneratePasswordResetUrlAction();
        $user = User::factory()->createOne();
        $token = 'token';
        $url = urldecode($action($user, $token));

        $apiEndpoint = action(ResetPasswordController::class);
        $this->assertStringContainsString("{$frontendUrl}?reset_url={$apiEndpoint}?token={$token}&email={$user->getEmailForVerification()}", $url);
    }

    public static function clientDataProvider(): array
    {
        return [
            ['web', 'http://localhost:3000'],
            ['mobile', 'http://localhost:4000'],
        ];
    }
}
