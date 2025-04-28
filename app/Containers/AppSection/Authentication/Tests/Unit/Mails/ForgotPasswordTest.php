<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Mails;

use App\Containers\AppSection\Authentication\Mails\ForgotPassword;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ForgotPassword::class)]
final class ForgotPasswordTest extends UnitTestCase
{
    public function testRenderMail(): void
    {
        $model = UserFactory::new()->createOne();
        $token = 'token-b510d059-5d0d-4618-9eb9-b315b4a07f12';
        $resetUrl = 'https://refresh-your-pass.world';

        $forgotPassword = new ForgotPassword($model, $token, $resetUrl);
        $view = $forgotPassword->build();

        $view->assertHasTo($model->email, $model->name);
        $view->assertSeeInHtml($token);
        $view->assertSeeInHtml(config('app.url'));
        $view->assertSeeInHtml($model->email);
    }
}
