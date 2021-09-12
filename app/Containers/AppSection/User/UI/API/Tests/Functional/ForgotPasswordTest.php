<?php

namespace App\Containers\AppSection\User\UI\API\Tests\Functional;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\ApiTestCase;
use App\Ship\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Mail;

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

    public function testForgotPasswordMailIsSent_IfUserExists(): void
    {
        $data = [
            'email' => 'admin@admin.com',
            'reseturl' => config('appSection-authentication.allowed-reset-password-urls')[0],
        ];

        $response = $this->makeCall($data);
        $response->assertStatus(204);
    }

    public function testIfUserNotExists_ShouldReturn404(): void
    {
        $data = [
            'email' => 'wrong@mail.test',
            'reseturl' => config('appSection-authentication.allowed-reset-password-urls')[0],
        ];

        $response = $this->makeCall($data);
        $response->assertStatus(404);
    }
}
