<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Tasks\CreatePasswordResetTokenTask;
use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class ResetPasswordTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/password/reset';

    protected array $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testResetPassword(): void
    {
        $this->getTestingUser([
            'email'    => 'ganldalf@the.grey',
            'password' => 'youShallNotPass',
        ]);
        $token = app(CreatePasswordResetTokenTask::class)->run($this->testingUser);
        $data = [
            'email'    => $this->testingUser->email,
            'password' => 's3cr3tPa$$',
            'token'    => $token,
        ];

        $testResponse = $this->makeCall($data);

        $testResponse->assertNoContent();
    }

    public function testResetPasswordWithInvalidEmail(): void
    {
        $data = [
            'email' => 'missing-at.test',
        ];

        $testResponse = $this->makeCall($data);

        $testResponse->assertUnprocessable();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('errors')
                ->where('errors.email.0', 'The email field must be a valid email address.')
                ->etc(),
        );
    }

    public function testResetPasswordWithInvalidPassword(): void
    {
        $data = [
            'password' => '((((()))))',
        ];

        $testResponse = $this->makeCall($data);

        $testResponse->assertUnprocessable();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('errors')
                ->has(
                    'errors.password',
                    static fn (AssertableJson $json): AssertableJson => $json
                        ->where('0', 'The password field must contain at least one uppercase and one lowercase letter.')
                        ->where('1', 'The password field must contain at least one letter.')
                        ->where('2', 'The password field must contain at least one number.'),
                )
                ->etc(),
        );
    }
}
