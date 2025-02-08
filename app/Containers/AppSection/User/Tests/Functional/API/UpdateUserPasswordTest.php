<?php

namespace App\Containers\AppSection\User\Tests\Functional\API;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\Functional\ApiTestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class UpdateUserPasswordTest extends ApiTestCase
{
    protected string $endpoint = 'patch@v1/users/{user_id}/password';

    public function testCanUpdatePasswordAsOwner(): void
    {
        $this->testingUser = User::factory()->createOne([
            'password' => 'Av@dakedavra!',
        ]);
        $data = [
            'current_password' => 'Av@dakedavra!',
            'new_password' => 'updated#Password111',
            'new_password_confirmation' => 'updated#Password111',
        ];

        $response = $this->injectId($this->testingUser->id, replace: '{user_id}')->makeCall($data);

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
        $this->assertTrue(Hash::check($data['new_password'], $this->testingUser->refresh()->password));
    }
}
