<?php

namespace App\Containers\AppSection\Authentication\UI\API\Tests\Functional;

use App\Containers\AppSection\Authentication\UI\API\Tests\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;

/**
 * Class ForgotPasswordTest.
 *
 * @group authentication
 * @group api
 */
class ForgotPasswordTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/password/forgot';

    protected bool $auth = false;

    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    public function testForgotPassword(): void
    {
        $reseturl = 'http://somereseturl.test/yea/something';
        config(['appSection-authentication.allowed-reset-password-urls' => $reseturl]);
        $data = [
            'email' => 'admin@admin.com',
            'reseturl' => $reseturl,
        ];

        $response = $this->makeCall($data);
        $response->assertStatus(204);
    }

    public function testForgotPasswordWithNotAllowedVerificationUrl(): void
    {
        config(['appSection-authentication.allowed-reset-password-urls' => []]);

        $data = [
            'email' => 'test@test.test',
            'password' => 'secret',
            'reseturl' => 'http://notallowed.test/wrong',
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(422);
        $response->assertJson(
            fn (AssertableJson $json) => $json->hasAll(['message', 'errors' => 1])
                ->where('errors.reseturl.0', 'The selected reseturl is invalid.')
        );
    }
}
