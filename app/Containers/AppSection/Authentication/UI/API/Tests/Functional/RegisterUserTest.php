<?php

namespace App\Containers\AppSection\Authentication\UI\API\Tests\Functional;

use App\Containers\AppSection\Authentication\Notifications\VerifyEmail;
use App\Containers\AppSection\Authentication\Notifications\Welcome;
use App\Containers\AppSection\Authentication\UI\API\Tests\ApiTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Testing\Fluent\AssertableJson;

/**
 * Class RegisterUserTest.
 *
 * @group authentication
 * @group api
 */
class RegisterUserTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/register';

    protected bool $auth = false;

    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    public function testGivenEmailVerificationEnabled_RegisterNewUserWithCredentials(): void
    {
        config(['appSection-authentication.require_email_verification' => true]);
        config(['appSection-authentication.allowed-verify-email-urls' => 'http://some.test/known/url']);

        $data = [
            'email' => 'apiato@mail.test',
            'password' => 's3cr3tPa$$',
            'verification_url' => 'http://some.test/known/url',
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                ->where('data.email', $data['email'])
                ->etc()
        );
    }

    public function testGivenEmailVerificationDisabled_RegisterNewUserWithCredentials(): void
    {
        config(['appSection-authentication.require_email_verification' => false]);
        $data = [
            'email' => 'apiato@mail.test',
            'password' => 's3cr3tPa$$',
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                ->where('data.email', $data['email'])
                ->etc()
        );
    }

    public function testRegisterNewUserUsingGetVerb(): void
    {
        $response = $this->endpoint('get@v1/register')->makeCall();

        $response->assertStatus(405);
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('message')
                ->where('message', 'The GET method is not supported for this route. Supported methods: POST.')
                ->etc()
        );
    }

    public function testRegisterExistingUser(): void
    {
        $userDetails = [
            'email' => 'apiato@mail.test',
            'password' => 'secret',
        ];

        $this->getTestingUser($userDetails);

        $data = [
            'email' => $userDetails['email'],
            'password' => $userDetails['password'],
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(422);
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('errors')
                ->where('errors.email.0', 'The email has already been taken.')
                ->etc()
        );
    }

    public function testRegisterNewUserWithoutData(): void
    {
        $data = [];

        $response = $this->makeCall($data);

        $response->assertStatus(422);

        if (config('appSection-authentication.require_email_verification')) {
            $response->assertJson(
                fn (AssertableJson $json) => $json->hasAll(['message', 'errors' => 3])
                    ->has(
                        'errors',
                        fn (AssertableJson $json) => $json->where('email.0', 'The email field is required.')
                            ->where('password.0', 'The password field is required.')
                            ->where('verification_url.0', 'The verification url field is required.')
                    )
            );
        } else {
            $response->assertJson(
                fn (AssertableJson $json) => $json->hasAll(['message', 'errors' => 2])
                    ->has(
                        'errors',
                        fn (AssertableJson $json) => $json->where('email.0', 'The email field is required.')
                            ->where('password.0', 'The password field is required.')
                    )
            );
        }
    }

    public function testRegisterNewUserWithInvalidEmail(): void
    {
        $data = [
            'email' => 'missing-at.test',
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(422);
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('errors')
                ->where('errors.email.0', 'The email must be a valid email address.')
                ->etc()
        );
    }

    public function testRegisterNewUserWithInvalidPassword(): void
    {
        $data = [
            'password' => '((((()))))',
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(422);
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('errors')
                ->has(
                    'errors.password',
                    fn (AssertableJson $json) => $json
                        ->where('0', 'The password must contain at least one uppercase and one lowercase letter.')
                        ->where('1', 'The password must contain at least one letter.')
                        ->where('2', 'The password must contain at least one number.')
                )
                ->etc()
        );
    }

    public function testRegisterNewUserWithNotAllowedVerificationUrl(): void
    {
        config(['appSection-authentication.require_email_verification' => true]);

        $data = [
            'email' => 'test@test.test',
            'password' => 's3cr3tPa$$',
            'verification_url' => 'http://notallowed.test/wrong/hopyfuly/noone/make/a/route/like/this',
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(422);
        $response->assertJson(
            fn (AssertableJson $json) => $json->hasAll(['message', 'errors' => 1])
                ->where('errors.verification_url.0', 'The selected verification url is invalid.')
        );
    }

    public function testGivenEmailVerificationDisabled_ShouldNotSendVerificationEmail(): void
    {
        config(['appSection-authentication.require_email_verification' => false]);

        Notification::fake();
        $data = [
            'email' => 'test@test.test',
            'password' => 's3cr3tPa$$',
            'verification_url' => config('appSection-authentication.allowed-verify-email-urls')[0],
        ];

        $response = $this->makeCall($data);
        $registeredUser = User::find($this->decode($response->json()['data']['id']));
        $response->assertStatus(200);
        Notification::assertSentTo($registeredUser, Welcome::class);
        Notification::assertNotSentTo($registeredUser, VerifyEmail::class);
    }
}
