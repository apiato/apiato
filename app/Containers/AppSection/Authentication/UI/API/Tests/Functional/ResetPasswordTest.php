<?php

namespace App\Containers\AppSection\Authentication\UI\API\Tests\Functional;

use App\Containers\AppSection\Authentication\Tasks\CreatePasswordResetTokenTask;
use App\Containers\AppSection\Authentication\UI\API\Tests\ApiTestCase;

/**
 * Class ResetPasswordTest.
 *
 * @group authentication
 * @group api
 */
class ResetPasswordTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/password/reset';

    protected array $access = [
        'roles' => '',
        'permissions' => '',
    ];

    public function testResetPassword(): void
    {
        $this->getTestingUser([
            'email' => 'someone@something.test',
            'password' => 'old pass',
        ]);
        $token = app(CreatePasswordResetTokenTask::class)->run($this->testingUser);
        $data = [
            'email' => $this->testingUser->email,
            'password' => 'new pass',
            'token' => $token,
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(204);
    }
}
