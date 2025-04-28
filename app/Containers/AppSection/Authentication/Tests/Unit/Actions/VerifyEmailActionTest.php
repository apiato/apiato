<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\VerifyEmailAction;
use App\Containers\AppSection\Authentication\Exceptions\InvalidEmailVerificationDataException;
use App\Containers\AppSection\Authentication\Notifications\EmailVerified;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\VerifyEmailRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(VerifyEmailAction::class)]
final class VerifyEmailActionTest extends UnitTestCase
{
    public function testVerifyEmail(): void
    {
        Notification::fake();
        $model = UserFactory::new()->unverified()->createOne();
        $action = app(VerifyEmailAction::class);
        $verifyEmailRequest = VerifyEmailRequest::injectData([
            'hash' => sha1((string) $model->email),
        ])->withUrlParameters([
            'user_id' => $model->id,
        ]);

        $action->run($verifyEmailRequest);

        $this->assertTrue($model->refresh()->hasVerifiedEmail());
        Notification::assertSentTo($model, EmailVerified::class);
    }

    public function testGivenEmailMismatchedShouldThrowProperException(): void
    {
        $this->expectException(InvalidEmailVerificationDataException::class);

        $model = UserFactory::new()->unverified()->createOne();
        $action = app(VerifyEmailAction::class);
        $verifyEmailRequest = VerifyEmailRequest::injectData([
            'hash' => sha1('nonematching@email.com'),
        ])->withUrlParameters([
            'user_id' => $model->id,
        ]);

        $action->run($verifyEmailRequest);
    }
}
