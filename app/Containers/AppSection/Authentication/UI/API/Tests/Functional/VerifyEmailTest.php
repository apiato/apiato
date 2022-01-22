<?php

namespace App\Containers\AppSection\Authentication\UI\API\Tests\Functional;

use App\Containers\AppSection\Authentication\Notifications\EmailVerified;
use App\Containers\AppSection\Authentication\UI\API\Tests\ApiTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Notification;

/**
 * Class VerifyEmailTest.
 *
 * @group authentication
 * @group api
 */
class VerifyEmailTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/email/verify/{id}/{hash}';

    protected array $access = [
        'roles' => '',
        'permissions' => '',
    ];

    public function testVerifyEmail(): void
    {
        Notification::fake();
        $unverifiedUser = User::factory()->unverified()->create();
        // enable email verification
        config(['appSection-authentication.require_email_verification' => true]);

        $response = $this->injectId($unverifiedUser->id)
            ->injectId(sha1($unverifiedUser->getEmailForVerification()), skipEncoding: true, replace: '{hash}')
            ->makeCall();

        $response->assertStatus(200);
        $unverifiedUser->refresh();
        $this->assertTrue($unverifiedUser->hasVerifiedEmail());
        Notification::assertSentTo($unverifiedUser, EmailVerified::class);
    }
}
