<?php

namespace App\Containers\AppSection\Authentication\UI\API\Tests\Functional;

use App\Containers\AppSection\Authentication\Notifications\VerifyEmail;
use App\Containers\AppSection\Authentication\UI\API\Tests\ApiTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Testing\Fluent\AssertableJson;

/**
 * Class SendVerificationEmailTest.
 *
 * @group authentication
 * @group api
 */
class SendVerificationEmailTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/email/verification-notification';

    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    public function testGivenEmailVerificationEnabled_SendVerificationEmail(): void
    {
        if (!config('appSection-authentication.require_email_verification')) {
            $this->markTestSkipped();
        }
        Notification::fake();
        $this->testingUser = User::factory()->unverified()->create();

        $data = [
            'verification_url' => config('appSection-authentication.allowed-verify-email-urls')[0],
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(202);
        Notification::assertSentTo($this->testingUser, VerifyEmail::class);
    }

    public function testSendingWithoutRequiredData_ShouldThrowError(): void
    {
        if (!config('appSection-authentication.require_email_verification')) {
            $this->markTestSkipped();
        }
        $data = [];

        $response = $this->makeCall($data);

        $response->assertStatus(422);

        $response->assertJson(
            fn (AssertableJson $json) => $json->hasAll(['message', 'errors' => 1])
                ->has(
                    'errors',
                    fn (AssertableJson $json) => $json->where('verification_url.0', 'The verification url field is required.')
                )
        );
    }

    public function testRegisterNewUserWithNotAllowedVerificationUrl(): void
    {
        if (!config('appSection-authentication.require_email_verification')) {
            $this->markTestSkipped();
        }
        $data = [
            'email' => 'test@test.test',
            'password' => 's3cr3tPa$$',
            'name' => 'Bruce Lee',
            'verification_url' => 'http://notallowed.test/wrong',
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(422);
        $response->assertJson(
            fn (AssertableJson $json) => $json->hasAll(['message', 'errors' => 1])
                ->where('errors.verification_url.0', 'The selected verification url is invalid.')
        );
    }

    public function testGivenEmailVerificationIsDisabled_ShouldThrow404(): void
    {
        if (config('appSection-authentication.require_email_verification')) {
            $this->markTestSkipped();
        }
        $response = $this->makeCall([]);

        $response->assertStatus(404);

    }
}
