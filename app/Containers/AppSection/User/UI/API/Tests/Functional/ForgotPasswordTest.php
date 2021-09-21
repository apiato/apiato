<?php

namespace App\Containers\AppSection\User\UI\API\Tests\Functional;

use App\Containers\AppSection\User\UI\API\Tests\ApiTestCase;

/**
 * Class ForgotPasswordTest.
 *
 * @group user
 * @group api
 */
class ForgotPasswordTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/password/forgot';

    protected bool $auth = false;

    protected array $access = [
        'roles' => '',
        'permissions' => '',
    ];

    public function testForgotPassword(): void
    {
        $data = [
            'email' => 'admin@admin.com',
            'reseturl' => config('appSection-authentication.allowed-reset-password-urls')[0],
        ];

        $response = $this->makeCall($data);
        $response->assertStatus(204);
    }
}
