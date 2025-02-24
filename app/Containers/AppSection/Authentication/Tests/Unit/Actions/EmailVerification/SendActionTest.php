<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\EmailVerification;

use App\Containers\AppSection\Authentication\Actions\EmailVerification\SendAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;

#[CoversClass(SendAction::class)]
final class SendActionTest extends UnitTestCase
{
    #[TestWith([false], 'verified')]
    #[TestWith([true], 'unverified')]
    public function testCanSendVerificationEmail(bool $unverified): void
    {
        Notification::fake();
        $user = tap(
            User::factory(),
            static function (UserFactory $factory) use ($unverified) {
                if ($unverified) {
                    $factory->unverified();
                }
            },
        )->createOne();
        $action = app(SendAction::class);

        $action->run($user);

        $verificationEnabled = $user instanceof MustVerifyEmail;
        if ($verificationEnabled && !$user->hasVerifiedEmail()) {
            Notification::assertSentTo($user, VerifyEmail::class);
        } else {
            Notification::assertNotSentTo($user, VerifyEmail::class);
        }
    }
}
