<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API\EmailVerification;

use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\EmailVerification\SendController;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class SendTest extends ApiTestCase
{
    public function testGivenEmailVerificationEnabledSendVerificationEmail(): void
    {
        if (!is_a(User::class, MustVerifyEmail::class, true)) {
            $this->markTestSkipped();
        }
        Notification::fake();
        $user = User::factory()->unverified()->createOne();
        $this->actingAs($user);

        $response = $this->postJson(action(SendController::class));

        $response->assertAccepted();
        Notification::assertSentTo($user, VerifyEmail::class);
    }
}
