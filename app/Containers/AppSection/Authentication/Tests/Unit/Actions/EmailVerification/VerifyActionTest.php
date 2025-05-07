<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\EmailVerification;

use App\Containers\AppSection\Authentication\Actions\EmailVerification\VerifyAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(VerifyAction::class)]
final class VerifyActionTest extends UnitTestCase
{
    public function testVerifyEmail(): void
    {
        Event::fake();
        $user = User::factory()->unverified()->createOne();
        $action = app(VerifyAction::class);

        $this->assertFalse($user->refresh()->hasVerifiedEmail());

        $action->run($user);

        $this->assertTrue($user->refresh()->hasVerifiedEmail());
        Event::assertDispatched(Verified::class, static function (Verified $event) use ($user) {
            return $event->user->is($user);
        });
    }
}
