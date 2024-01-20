<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Notifications\EmailVerified;
use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversNothing]
final class VerifyEmailTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/email/verify/{id}/{hash}';

    protected array $access = [
        'permissions' => null,
        'roles' => null,
    ];

    public function testVerifyEmail(): void
    {
        $this->markTestSkipped();
        Notification::fake();
        $unverifiedUser = UserFactory::new()->unverified()->createOne();
        $hashedEmail = sha1($unverifiedUser->getEmailForVerification());
        // enable email verification
        config(['appSection-authentication.require_email_verification' => true]);
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

        $response = $this->injectId($unverifiedUser->id)
            ->injectId($hashedEmail, skipEncoding: true, replace: '{hash}')
            ->endpoint($this->endpoint . "?expires=$expires&signature=$signature")
            ->makeCall();

        $response->assertOk();
        $unverifiedUser->refresh();
        $this->assertTrue($unverifiedUser->hasVerifiedEmail());
        Notification::assertSentTo($unverifiedUser, EmailVerified::class);
    }

    public function testVerifyEmailShouldNotBeAcceptedIfRoutesSignatureIsNotVerified(): void
    {
        $this->markTestSkipped();
        Notification::fake();
        $unverifiedUser = UserFactory::new()->unverified()->createOne();
        $hashedEmail = sha1($unverifiedUser->getEmailForVerification());
        // enable email verification
        config(['appSection-authentication.require_email_verification' => true]);
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
        $signature = 'invalid_sig';

        $response = $this->injectId($unverifiedUser->id)
            ->injectId($hashedEmail, skipEncoding: true, replace: '{hash}')
            ->endpoint($this->endpoint . "?expires=$expires&signature=$signature")
            ->makeCall();

        $response->assertForbidden();
    }
}
