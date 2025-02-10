<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Notifications\EmailVerified;
use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\VerifyEmailController;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class VerifyEmailTest extends ApiTestCase
{
    public function testVerifyEmail(): void
    {
        Notification::fake();
        $unverifiedUser = User::factory()->unverified()->createOne();
        $hashedEmail = sha1($unverifiedUser->getEmailForVerification());
        // enable email verification
        config()->set('appSection-authentication.require_email_verification', true);
        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(30),
            [
                'user_id' => $unverifiedUser->getHashedKey(),
                'hash' => $hashedEmail,
            ],
        );

        $match = [];
        $expires = $match[preg_match('/expires=(.*?)&/', $url, $match)];
        $signature = $match[preg_match('/signature=(.*)/', $url, $match)];

        $response = $this->postJson(
            action(VerifyEmailController::class, [
                'user_id' => $unverifiedUser->getHashedKey(),
                'hash' => $hashedEmail,
                'expires' => $expires,
                'signature' => $signature,
            ]),
        );

        $response->assertOk();
        $unverifiedUser->refresh();
        $this->assertTrue($unverifiedUser->hasVerifiedEmail());
        Notification::assertSentTo($unverifiedUser, EmailVerified::class);
    }

    public function testVerifyEmailShouldNotBeAcceptedIfRoutesSignatureIsNotVerified(): void
    {
        Notification::fake();
        $unverifiedUser = User::factory()->unverified()->createOne();
        $hashedEmail = sha1($unverifiedUser->getEmailForVerification());
        // enable email verification
        config()->set('appSection-authentication.require_email_verification', true);
        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(30),
            [
                'user_id' => $unverifiedUser->getHashedKey(),
                'hash' => $hashedEmail,
            ],
        );

        $match = [];
        $expires = $match[preg_match('/expires=(.*?)&/', $url, $match)];
        $signature = 'invalid_sig';

        $response = $this->postJson(
            action(VerifyEmailController::class, [
                'user_id' => $unverifiedUser->getHashedKey(),
                'hash' => $hashedEmail,
                'expires' => $expires,
                'signature' => $signature,
            ]),
        );

        $response->assertForbidden();
    }
}
