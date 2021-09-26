<?php

namespace App\Containers\AppSection\User\UI\API\Tests\Functional;

use App\Containers\AppSection\User\UI\API\Tests\ApiTestCase;
use Illuminate\Support\Carbon;
use Illuminate\Testing\Fluent\AssertableJson;

/**
 * Class UpdateUserTest.
 *
 * @group user
 * @group api
 */
class UpdateUserTest extends ApiTestCase
{
    protected string $endpoint = 'patch@v1/users/{id}';

    protected array $access = [
        'roles' => '',
        'permissions' => 'update-users',
    ];

    public function testUpdateExistingUser(): void
    {
        $user = $this->getTestingUser();
        $data = [
            'name' => 'Updated Name',
            'password' => 'updated#Password',
            'gender' => 'male',
            'birth' => '2015-10-15',
        ];

        $response = $this->injectId($user->id)->makeCall($data);

        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'object' => 'User',
            'email' => $user->email,
            'name' => $data['name'],
            'gender' => $data['gender'],
            'birth' => Carbon::parse($data['birth']),
        ]);
        $this->assertDatabaseHas('users', ['name' => $data['name']]);
    }

    public function testUpdateNonExistingUser(): void
    {
        $data = [
            'name' => 'Updated Name',
        ];
        $fakeUserId = 7777;

        $response = $this->injectId($fakeUserId)->makeCall($data);

        $response->assertStatus(422);
        $this->assertResponseContainKeyValue([
            'message' => 'The given data was invalid.',
        ]);
    }

    public function testUpdateExistingUserWithoutData(): void
    {
        $user = $this->getTestingUser();

        $response = $this->injectId($user->id)->makeCall();

        $response->assertStatus(417);

        $response->assertJson(
            fn (AssertableJson $json) =>
                $json->has('message')
                    ->has('errors')
                    ->where('message', 'Inputs are empty.')
                    ->etc()
        );
    }

    public function testUpdateExistingUserWithEmptyValues(): void
    {
        $data = [
            'name' => '',
            'password' => '',
            'gender' => '',
            'birth' => '',
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(422);
        $this->assertValidationErrorContain([
            // messages should be updated after modifying the validation rules, to pass this test
            'password' => 'The password must be at least 6 characters.',
            'name' => 'The name must be at least 2 characters.',
            'gender' => 'The selected gender is invalid.',
            'birth' => 'The birth is not a valid date.',
        ]);
    }
}
