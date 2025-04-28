<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Functional\API;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class GetUserProfileTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/profile';

    protected array $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testCanGetOwnProfile(): void
    {
        $userModel = $this->getTestingUser();

        $testResponse = $this->makeCall();

        $testResponse->assertOk();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has(
                'data',
                static fn (AssertableJson $json): AssertableJson => $json
                    ->where('object', 'User')
                    ->where('id', $userModel->getHashedKey())
                    ->where('email', $userModel->email)
                    ->whereType('email_verified_at', 'string')
                    ->where('name', $userModel->name)
                    ->where('gender', $userModel->gender->value)
                    ->whereType('birth', 'string')
                    ->etc(),
            )->etc(),
        );
    }

    public function testCannotGetProfileByUnauthenticatedUser(): void
    {
        $this->testingUser = UserFactory::new()->createOne();

        $testResponse = $this->auth(false)->makeCall();

        $testResponse->assertUnauthorized();
    }
}
