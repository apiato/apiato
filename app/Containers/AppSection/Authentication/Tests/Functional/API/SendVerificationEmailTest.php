<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Notifications\VerifyEmail;
use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Support\Facades\Notification;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class SendVerificationEmailTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/email/verification-notification';

    protected array $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testGivenEmailVerificationEnabledSendVerificationEmail(): void
    {
        Notification::fake();
        $this->testingUser = UserFactory::new()->unverified()->createOne();
        config()->set('appSection-authentication.require_email_verification', true);

        $data = [
            'verification_url' => config('appSection-authentication.allowed-verify-email-urls')[0],
        ];

        $testResponse = $this->makeCall($data);

        $testResponse->assertAccepted();
        Notification::assertSentTo($this->testingUser, VerifyEmail::class);
    }

    public function testSendingWithoutRequiredDataShouldThrowError(): void
    {
        $data = [];

        $testResponse = $this->makeCall($data);

        $testResponse->assertUnprocessable();

        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has(
                'errors',
                static fn (AssertableJson $json): AssertableJson => $json->where('verification_url.0', 'The verification url field is required.'),
            )->etc(),
        );
    }

    public function testRegisterNewUserWithNotAllowedVerificationUrl(): void
    {
        $data = [
            'email'            => 'ganldalf@the.grey',
            'password'         => 's3cr3tPa$$',
            'name'             => 'Bruce Lee',
            'verification_url' => 'http://notallowed.test/wrong',
        ];

        $testResponse = $this->makeCall($data);

        $testResponse->assertUnprocessable();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has(
                'errors',
                static fn (AssertableJson $json): AssertableJson => $json->where('verification_url.0', 'The selected verification url is invalid.'),
            )->etc(),
        );
    }
}
