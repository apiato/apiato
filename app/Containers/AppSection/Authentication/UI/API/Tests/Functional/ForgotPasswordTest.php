<?php

namespace App\Containers\AppSection\Authentication\UI\API\Tests\Functional;

use App\Containers\AppSection\Authentication\UI\API\Tests\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;

/**
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
        $response->assertNoContent();
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

        $response->assertUnprocessable();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has(
                'errors',
                fn (AssertableJson $json) => $json
                    ->where('reseturl.0', 'The selected reseturl is invalid.')
            )->etc()
        );
    }
}
