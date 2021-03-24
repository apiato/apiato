<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Tests\ApiTestCase;

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
            'birth' => '20151015'
        ];

        // send the HTTP request
        $response = $this->injectId($user->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // assert returned user is the updated one
        $this->assertResponseContainKeyValue([
            'object' => 'User',
            'email' => $user->email,
            'name' => $data['name'],
            'gender' => $data['gender'],
            'birth' => $data['birth']
        ]);

        // assert data was updated in the database
        $this->assertDatabaseHas('users', ['name' => $data['name']]);
    }

    public function testUpdateNonExistingUser(): void
    {
        $data = [
            'name' => 'Updated Name',
        ];

        $fakeUserId = 7777;

        // send the HTTP request
        $response = $this->injectId($fakeUserId)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue([
            'message' => 'The given data was invalid.'
        ]);
    }

    public function testUpdateExistingUserWithoutData(): void
    {
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue([
            'message' => 'The given data was invalid.'
        ]);
    }

    public function testUpdateExistingUserWithEmptyValues(): void
    {
        $data = [
            'name' => '',
            'password' => '',
            'gender' => '',
            'birth' => ''
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertValidationErrorContain([
            // messages should be updated after modifying the validation rules, to pass this test
            'password' => 'The password must be at least 6 characters.',
            'name' => 'The name must be at least 2 characters.',
            'gender' => 'The selected gender is invalid.',
            'birth' => 'The birth does not match the format Ymd.'
        ]);
    }
}
