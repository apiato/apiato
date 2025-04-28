<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\ForgotPasswordAction;
use App\Containers\AppSection\Authentication\Mails\ForgotPassword;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\ForgotPasswordRequest;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ForgotPasswordAction::class)]
final class ForgotPasswordActionTest extends UnitTestCase
{
    public function testIfUserExistsShouldReturnTrue(): void
    {
        Mail::fake();
        $userModel = $this->getTestingUser();
        $data = [
            'email'    => $userModel->email,
            'reseturl' => 'http://localhost',
        ];

        $forgotPasswordRequest = new ForgotPasswordRequest($data);
        $result = app(ForgotPasswordAction::class)->run($forgotPasswordRequest);

        $this->assertTrue($result);
        Mail::assertQueued(ForgotPassword::class);
    }

    public function testIfUserNotExistsShouldTrue(): void
    {
        Mail::fake();
        $data = [
            'email' => 'ganldalf@the.grey',
        ];

        $forgotPasswordRequest = new ForgotPasswordRequest($data);
        $result = app(ForgotPasswordAction::class)->run($forgotPasswordRequest);

        $this->assertTrue($result);
        Mail::assertNotQueued(ForgotPassword::class);
    }
}
