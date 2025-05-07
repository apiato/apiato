<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API\EmailVerification;

use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\EmailVerification\SendController;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(SendController::class)]
final class SendTest extends ApiTestCase
{
    public function testGivenEmailVerificationEnabledSendVerificationEmail(): void
    {
        Notification::fake();
        $user = User::factory()->unverified()->createOne();
        $this->actingAs($user);

        $response = $this->postJson(action(SendController::class));

        $response->assertAccepted();
        if ($user instanceof MustVerifyEmail) {
            Notification::assertSentTo($user, VerifyEmail::class);
        } else {
            Notification::assertNotSentTo($user, VerifyEmail::class);
        }
    }
}
