<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Tasks\CreatePasswordResetTokenTask;
use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversNothing]
final class ResetPasswordTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/password/reset';

    protected array $access = [
        'permissions' => null,
        'roles' => null,
    ];

    public function testResetPassword(): void
    {
        $this->getTestingUser([
            'email' => 'ganldalf@the.grey',
            'password' => 'youShallNotPass',
        ]);
        $token = app(CreatePasswordResetTokenTask::class)->run($this->testingUser);
        $data = [
            'email' => $this->testingUser->email,
            'password' => 's3cr3tPa$$',
            'token' => $token,
        ];

        $response = $this->makeCall($data);

        $response->assertNoContent();
    }

    public function testResetPasswordWithInvalidEmail(): void
    {
        $data = [
            'email' => 'missing-at.test',
        ];

        $response = $this->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(
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

        $response = $this->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(
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
