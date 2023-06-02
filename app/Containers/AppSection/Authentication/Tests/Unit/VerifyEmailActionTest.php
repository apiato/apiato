<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Actions\VerifyEmailAction;
use App\Containers\AppSection\Authentication\Exceptions\InvalidEmailVerificationDataException;
use App\Containers\AppSection\Authentication\Notifications\EmailVerified;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\VerifyEmailRequest;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Notification;

/**
 * @group authentication
 * @group unit
 */
class VerifyEmailActionTest extends UnitTestCase
{
    public function testVerifyEmail(): void
    {
        Notification::fake();
        $user = User::factory()->unverified()->create();
        $action = app(VerifyEmailAction::class);
        $request = VerifyEmailRequest::injectData([
            'hash' => sha1($user->email),
        ])->withUrlParameters([
            'id' => $user->id,
        ]);

        $action->run($request);

        $this->assertTrue($user->refresh()->hasVerifiedEmail());
        Notification::assertSentTo($user, EmailVerified::class);
    }

    public function testGivenEmailMismatchedShouldThrowProperException(): void
    {
        $this->expectException(InvalidEmailVerificationDataException::class);

        $user = User::factory()->unverified()->create();
        $action = app(VerifyEmailAction::class);
        $request = VerifyEmailRequest::injectData([
            'hash' => sha1('nonematching@email.com'),
        ])->withUrlParameters([
            'id' => $user->id,
        ]);

        $action->run($request);
    }
}
