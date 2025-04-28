<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Functional\API;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\Functional\ApiTestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class UpdateUserPasswordTest extends ApiTestCase
{
    protected string $endpoint = 'patch@v1/users/{user_id}/password';

    protected array $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testCanUpdatePasswordAsOwner(): void
    {
        $this->testingUser = UserFactory::new()->createOne([
            'password' => 'Av@dakedavra!',
        ]);
        $data = [
            'current_password'          => 'Av@dakedavra!',
            'new_password'              => 'updated#Password111',
            'new_password_confirmation' => 'updated#Password111',
        ];

        $testResponse = $this->injectId($this->testingUser->id, replace: '{user_id}')->makeCall($data);

        $testResponse->assertOk();
        $testResponse->assertJson(
            fn (AssertableJson $json): AssertableJson => $json->has(
                'data',
                fn (AssertableJson $json): AssertableJson => $json
                    ->where('object', 'User')
                    ->where('email', $this->testingUser->email)
                    ->missing('password')
                    ->etc(),
            )->etc(),
        );
        $this->assertTrue(Hash::check($data['new_password'], $this->testingUser->refresh()->password));
    }
}
