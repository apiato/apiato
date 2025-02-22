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
    #[DataProvider('appDataProvider')]
    public function testItCanGenerateCorrectUrl(string|null $appId, string $appUrl): void
    {
        if ($appId) {
            request()->headers->set('App-Identifier', $appId);
        }
        config(['apiato.apps' => [
            'web' => ['url' => 'http://localhost:3000'],
            'desktop' => ['url' => 'http://localhost:5000'],
            'mobile' => ['url' => 'http://localhost:4000'],
        ]]);
        $action = new GeneratePasswordResetUrlAction();
        $user = User::factory()->createOne();
        $token = 'token';
        $url = urldecode($action($user, $token));

        $apiEndpoint = action(ResetPasswordController::class);
        $this->assertStringContainsString("{$appUrl}?reset_url={$apiEndpoint}?token={$token}&email={$user->getEmailForVerification()}", $url);
    }

    public static function appDataProvider(): array
    {
        return [
            ['web', 'http://localhost:3000'],
            ['mobile', 'http://localhost:4000'],
            'falls back to default' => [null, 'http://localhost:3000'],
        ];
    }

    public function testItThrowsIfInvalidAppIdIsProvided(): void
    {
        $this->expectExceptionMessage("App-Identifier header value 'non-existing' is not valid. Allowed values are: web, desktop, mobile");

        request()->headers->set('App-Identifier', 'non-existing');
        config(['apiato.apps' => [
            'web' => ['url' => 'http://localhost:3000'],
            'desktop' => ['url' => 'http://localhost:5000'],
            'mobile' => ['url' => 'http://localhost:4000'],
        ]]);
        $action = new GeneratePasswordResetUrlAction();
        $user = User::factory()->createOne();
        $token = 'token';

        $action($user, $token);
    }
}
