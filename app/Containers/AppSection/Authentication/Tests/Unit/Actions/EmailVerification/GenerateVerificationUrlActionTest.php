<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\EmailVerification;

use App\Containers\AppSection\Authentication\Actions\EmailVerification\GenerateVerificationUrlAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\EmailVerification\VerifyController;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(GenerateVerificationUrlAction::class)]
final class GenerateVerificationUrlActionTest extends UnitTestCase
{
    #[DataProvider('appDataProvider')]
    public function testItCanGenerateCorrectUrl(string|null $appId, string $appUrl): void
    {
        $this->freezeTime();
        if ($appId) {
            request()->headers->set('App-Identifier', $appId);
        }
        config(['apiato.apps' => [
            'web' => ['url' => 'http://localhost:3000'],
            'desktop' => ['url' => 'http://localhost:5000'],
            'mobile' => ['url' => 'http://localhost:4000'],
        ]]);
        $action = new GenerateVerificationUrlAction();
        $user = User::factory()->createOne();

        $url = $action($user);

        $apiEndpoint = action(VerifyController::class, [
            'id' => $user->getHashedKey(),
            'hash' => sha1($user->getEmailForVerification()),
        ]);
        $expiration = Carbon::now()->addMinutes(config('auth.verification.expire', 60))->unix();
        $this->assertStringContainsString("{$appUrl}?verification_url={$apiEndpoint}?expires={$expiration}&signature=", $url);
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
        $action = new GenerateVerificationUrlAction();
        $user = User::factory()->createOne();

        $action($user);
    }
}
