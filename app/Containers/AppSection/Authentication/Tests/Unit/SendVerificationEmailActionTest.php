<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Actions\SendVerificationEmailAction;
use App\Containers\AppSection\Authentication\Notifications\VerifyEmail;
use App\Containers\AppSection\Authentication\Tests\TestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\SendVerificationEmailRequest;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Notification;

/**
 * Class SendVerificationEmailActionTest.
 *
 * @group authentication
 * @group unit
 */
class SendVerificationEmailActionTest extends TestCase
{
    public function testSendVerificationEmailAction(): void
    {
        Notification::fake();
        $unverifiedUser = User::factory()->unverified()->create();
        // enable email verification
        config(['appSection-authentication.require_email_verification' => true]);
        $request = SendVerificationEmailRequest::injectData([], $unverifiedUser);


        app(SendVerificationEmailAction::class)->run($request);

        Notification::assertSentTo($unverifiedUser, VerifyEmail::class);
    }
}
