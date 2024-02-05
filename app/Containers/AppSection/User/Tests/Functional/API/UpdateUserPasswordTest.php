<?php

namespace App\Containers\AppSection\User\Tests\Functional\API;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversNothing]
final class UpdateUserPasswordTest extends ApiTestCase
{
    protected string $endpoint = 'patch@v1/users/{id}/password';

    protected array $access = [
        'permissions' => null,
        'roles' => null,
    ];

    public function testCanUpdatePasswordAsOwner(): void
    {
        $this->testingUser = UserFactory::new()->createOne([
            'password' => 'Av@dakedavra!',
        ]);
        $data = [
            'current_password' => 'Av@dakedavra!',
            'new_password' => 'updated#Password111',
        ];

        $response = $this->injectId($this->testingUser->id)->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json): AssertableJson => $json->has(
                'data',
                fn (AssertableJson $json): AssertableJson => $json
                    ->where('object', 'User')
                    ->where('email', $this->testingUser->email)
                    ->missing('password')
                    ->etc(),
            )->etc(),
        );
    }
}
