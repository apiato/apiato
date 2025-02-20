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
        $verificationEnabled = is_a(User::class, MustVerifyEmail::class, true);
        Notification::fake();
        $user = User::factory()->unverified()->createOne();
        $action = app(SendAction::class);
        $request = SendRequest::injectData([], $user);

        $action->run($request);

        if ($verificationEnabled) {
            Notification::assertSentTo($user, VerifyEmail::class);
        }
        if (!$verificationEnabled) {
            Notification::assertNotSentTo($user, VerifyEmail::class);
        }
    }

//    public function testGivenEmailVerificationEnabledSendVerificationEmail(): void
//    {
//        if (!is_a(User::class, MustVerifyEmail::class, true)) {
//            $this->markTestSkipped();
//        }
//        Notification::fake();
//        $unverifiedUser = User::factory()->unverified()->createOne();
//        app(SendVerificationEmailTask::class)->run($unverifiedUser, 'this_doesnt_matter_for_the_test');
//
//        Notification::assertSentTo($unverifiedUser, VerifyEmail::class);
//    }
//
//    public function testGivenEmailVerificationDisabledShouldNotSendVerificationEmail(): void
//    {
//        if (is_a(User::class, MustVerifyEmail::class, true)) {
//            $this->markTestSkipped();
//        }
//        Notification::fake();
//        $unverifiedUser = User::factory()->unverified()->createOne();
//        app(SendVerificationEmailTask::class)->run($unverifiedUser);
//
//        Notification::assertNotSentTo($unverifiedUser, VerifyEmail::class);
//    }
}
