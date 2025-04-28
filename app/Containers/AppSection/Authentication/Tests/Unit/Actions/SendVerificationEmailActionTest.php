<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\SendVerificationEmailAction;
use App\Containers\AppSection\Authentication\Tasks\SendVerificationEmailTask;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\SendVerificationEmailRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(SendVerificationEmailAction::class)]
final class SendVerificationEmailActionTest extends UnitTestCase
{
    public function testCanSendVerificationEmail(): void
    {
        $mock = $this->mock(SendVerificationEmailTask::class);
        $action = app(SendVerificationEmailAction::class);
        $sendVerificationEmailRequest = SendVerificationEmailRequest::injectData([
            'verification_url' => 'http://localhost',
        ], UserFactory::new()->createOne());
        $mock->expects()->run($sendVerificationEmailRequest->user(), $sendVerificationEmailRequest->verification_url);

        $action->run($sendVerificationEmailRequest);
    }
}
