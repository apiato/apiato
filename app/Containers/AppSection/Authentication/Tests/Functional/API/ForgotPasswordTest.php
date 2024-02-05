<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversNothing]
final class ForgotPasswordTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/password/forgot';

    protected bool $auth = false;

    protected array $access = [
        'permissions' => null,
        'roles' => null,
    ];

    public function testForgotPassword(): void
    {
        $reseturl = 'http://somereseturl.test/yea/something';
        config()->set('appSection-authentication.allowed-reset-password-urls', $reseturl);
        $data = [
            'email' => 'admin@admin.com',
            'reseturl' => $reseturl,
        ];

        $response = $this->makeCall($data);
        $response->assertNoContent();
    }

    public function testForgotPasswordWithNotAllowedVerificationUrl(): void
    {
        config()->set('appSection-authentication.allowed-reset-password-urls', []);

        $data = [
            'email' => 'ganldalf@the.grey',
            'password' => 'youShallNotPass',
            'reseturl' => 'http://notallowed.test/wrong',
        ];

        $response = $this->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has(
                'errors',
                static fn (AssertableJson $json): AssertableJson => $json
                    ->where('reseturl.0', 'The selected reseturl is invalid.'),
            )->etc(),
        );
    }
}
