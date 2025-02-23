<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\EmailVerification;

use App\Containers\AppSection\Authentication\Actions\EmailVerification\GenerateVerificationUrlAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\EmailVerification\VerifyController;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(GenerateVerificationUrlAction::class)]
final class GenerateVerificationUrlActionTest extends UnitTestCase
{
    public function testItCanGenerateCorrectUrl(): void
    {
        $this->freezeTime();
        request()->headers->set('App-Identifier', 'my-app');
        $appUrl = 'http://localhost:3000';
        config(['apiato.apps' => [
            'my-app' => ['url' => $appUrl],
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
}
