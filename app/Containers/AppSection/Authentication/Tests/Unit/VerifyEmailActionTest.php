<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Actions\VerifyEmailAction;
use App\Containers\AppSection\Authentication\Notifications\EmailVerified;
use App\Containers\AppSection\Authentication\Tests\TestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\VerifyEmailRequest;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Notification;

/**
 * Class VerifyEmailActionTest.
 *
 * @group authentication
 * @group unit
 */
class VerifyEmailActionTest extends TestCase
{
    public function testSendVerificationEmailAction(): void
    {
        Notification::fake();
        $unverifiedUser = User::factory()->unverified()->create();
        // enable email verification
        config(['appSection-authentication.require_email_verification' => true]);
        $request = VerifyEmailRequest::injectData([], $unverifiedUser);


        app(VerifyEmailAction::class)->run($request);

        $this->assertTrue($unverifiedUser->hasVerifiedEmail());
        Notification::assertSentTo($unverifiedUser, EmailVerified::class);
    }
}
