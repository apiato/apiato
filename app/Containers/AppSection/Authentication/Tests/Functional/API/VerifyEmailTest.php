<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Notifications\EmailVerified;
use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class VerifyEmailTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/email/verify/{user_id}/{hash}';

    protected array $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testVerifyEmail(): void
    {
        Notification::fake();
        $model = UserFactory::new()->unverified()->createOne();
        $hashedEmail = sha1((string) $model->getEmailForVerification());
        // enable email verification
        config()->set('appSection-authentication.require_email_verification', true);
        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(30),
            [
                'user_id' => $model->getHashedKey(),
                'hash'    => $hashedEmail,
            ],
        );

        $match = [];
        $expires = $match[preg_match('/expires=(.*?)&/', $url, $match)];
        $signature = $match[preg_match('/signature=(.*)/', $url, $match)];

        $testResponse = $this->injectId($model->id, replace: '{user_id}')
            ->injectId($hashedEmail, skipEncoding: true, replace: '{hash}')
            ->endpoint($this->endpoint . \sprintf('?expires=%s&signature=%s', $expires, $signature))
            ->makeCall();

        $testResponse->assertOk();

        $model->refresh();
        $this->assertTrue($model->hasVerifiedEmail());
        Notification::assertSentTo($model, EmailVerified::class);
    }

    public function testVerifyEmailShouldNotBeAcceptedIfRoutesSignatureIsNotVerified(): void
    {
        Notification::fake();
        $model = UserFactory::new()->unverified()->createOne();
        $hashedEmail = sha1((string) $model->getEmailForVerification());
        // enable email verification
        config()->set('appSection-authentication.require_email_verification', true);
        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(30),
            [
                'user_id' => $model->getHashedKey(),
                'hash'    => $hashedEmail,
            ],
        );

        $match = [];
        $expires = $match[preg_match('/expires=(.*?)&/', $url, $match)];
        $signature = 'invalid_sig';

        $testResponse = $this->injectId($model->id, replace: '{user_id}')
            ->injectId($hashedEmail, skipEncoding: true, replace: '{hash}')
            ->endpoint($this->endpoint . \sprintf('?expires=%s&signature=%s', $expires, $signature))
            ->makeCall();

        $testResponse->assertForbidden();
    }
}
