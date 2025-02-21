<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\EmailVerification;

use App\Containers\AppSection\Authentication\Actions\EmailVerification\SendAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\EmailVerification\SendRequest;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(SendAction::class)]
class SendActionTest extends UnitTestCase
{
    public function testCanSendVerificationEmail(): void
    {
        Notification::fake();
        $user = User::factory()->unverified()->createOne();
        $action = app(SendAction::class);
        $request = SendRequest::injectData([], $user);

        $action->run($request);

        $verificationEnabled = is_a($user, MustVerifyEmail::class);
        if ($verificationEnabled) {
            Notification::assertSentTo($user, VerifyEmail::class);
        }
        if (!$verificationEnabled) {
            Notification::assertNotSentTo($user, VerifyEmail::class);
        }
    }
}
