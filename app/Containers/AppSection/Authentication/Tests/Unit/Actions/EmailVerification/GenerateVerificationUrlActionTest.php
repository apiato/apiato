<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\EmailVerification;

use App\Containers\AppSection\Authentication\Actions\EmailVerification\GenerateVerificationUrlAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(GenerateVerificationUrlAction::class)]
final class GenerateVerificationUrlActionTest extends UnitTestCase
{
    #[DataProvider('clientDataProvider')]
    public function testItCanGenerateCorrectUrl(string $clientType, string $frontendUrl): void
    {
        $this->freezeTime();
        request()->headers->set('Client-Type', $clientType);
        config(['apiato.frontend.urls' => [
            'web' => 'http://localhost:3000',
            'desktop' => 'http://localhost:5000',
            'mobile' => 'http://localhost:4000',
        ]]);
        $action = new GenerateVerificationUrlAction();
        $user = User::factory()->createOne();

        $url = $action($user);

        $emailHash = sha1($user->getEmailForVerification());
        $this->assertStringContainsString("{$frontendUrl}?verification_url=https://api.apiato.ddev.site/v1/email/verify/{$user->getHashedKey()}/{$emailHash}?expires=", $url);
        $expiration = Carbon::now()->addMinutes(config('auth.verification.expire', 60))->unix();
        $this->assertStringContainsString("?expires={$expiration}", $url);
        $this->assertStringContainsString('&signature=', $url);
    }

    public static function clientDataProvider(): array
    {
        return [
            ['web', 'http://localhost:3000'],
            ['mobile', 'http://localhost:4000'],
        ];
    }
}
