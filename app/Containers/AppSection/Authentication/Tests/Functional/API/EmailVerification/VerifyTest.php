<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API\EmailVerification;

use App\Containers\AppSection\Authentication\Notifications\EmailVerified;
use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\EmailVerification\VerifyController;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(VerifyController::class)]
final class VerifyTest extends ApiTestCase
{
    public function testVerifyEmail(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
        Notification::fake();
        $unverifiedUser = User::factory()->unverified()->createOne();
        $hashedEmail = sha1($unverifiedUser->getEmailForVerification());
        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(30),
            [
                'id' => $unverifiedUser->getHashedKey(),
                'hash' => $hashedEmail,
            ],
        );

        $match = [];
        $expires = $match[preg_match('/expires=(.*?)&/', $url, $match)];
        $signature = $match[preg_match('/signature=(.*)/', $url, $match)];

        $response = $this->postJson(
            action(VerifyController::class, [
                'id' => $unverifiedUser->getHashedKey(),
                'hash' => $hashedEmail,
                'expires' => $expires,
                'signature' => $signature,
            ]),
        );

        $response->assertOk();
        $unverifiedUser->refresh();
        if ($unverifiedUser instanceof MustVerifyEmail) {
            $this->assertTrue($unverifiedUser->hasVerifiedEmail());
            Notification::assertSentTo($unverifiedUser, EmailVerified::class);
        } else {
            $this->assertNull($unverifiedUser->email_verified_at);
            Notification::assertNotSentTo($unverifiedUser, EmailVerified::class);
        }
    }
}
