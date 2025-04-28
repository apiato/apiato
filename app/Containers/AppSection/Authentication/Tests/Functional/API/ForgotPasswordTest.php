<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class ForgotPasswordTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/password/forgot';

    protected bool $auth = false;

    protected array $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testForgotPassword(): void
    {
        $reseturl = 'http://somereseturl.test/yea/something';
        config()->set('appSection-authentication.allowed-reset-password-urls', $reseturl);
        $data = [
            'email'    => 'admin@admin.com',
            'reseturl' => $reseturl,
        ];

        $testResponse = $this->makeCall($data);
        $testResponse->assertNoContent();
    }

    public function testForgotPasswordWithNotAllowedVerificationUrl(): void
    {
        config()->set('appSection-authentication.allowed-reset-password-urls', []);

        $data = [
            'email'    => 'ganldalf@the.grey',
            'password' => 'youShallNotPass',
            'reseturl' => 'http://notallowed.test/wrong',
        ];

        $testResponse = $this->makeCall($data);

        $testResponse->assertUnprocessable();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has(
                'errors',
                static fn (AssertableJson $json): AssertableJson => $json
                    ->where('reseturl.0', 'The selected reseturl is invalid.'),
            )->etc(),
        );
    }
}
