<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\EmailVerification;

use App\Containers\AppSection\Authentication\Actions\EmailVerification\GenerateUrlAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\EmailVerification\VerifyController;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Apps\AppFactory;
use Illuminate\Support\Facades\Date;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(GenerateUrlAction::class)]
final class GenerateUrlActionTest extends UnitTestCase
{
    public function testItCanGenerateCorrectUrl(): void
    {
        $this->freezeTime();
        request()->headers->set('App-Identifier', 'web');
        $action = new GenerateUrlAction();
        $user = User::factory()->createOne();

        $url = $action($user);

        $apiEndpoint = action(VerifyController::class, [
            'id' => $user->getHashedKey(),
            'hash' => sha1($user->getEmailForVerification()),
        ]);
        $expiration = Date::now()->addMinutes(config('auth.verification.expire', 60))->unix();
        $this->assertStringContainsString(urlencode(AppFactory::current()->verifyEmailUrl() . "?verification_url={$apiEndpoint}?expires={$expiration}&signature="), $url);
    }
}
