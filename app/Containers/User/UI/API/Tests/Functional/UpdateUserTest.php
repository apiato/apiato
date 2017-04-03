<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Tests\TestCase;

/**
 * Class UpdateUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserTest extends TestCase
{

    protected $endpoint = 'put@users';

    protected $access = [
        'roles'       => '',
        'permissions' => 'update-users',
    ];

    public function testUpdateExistingUser_()
    {

        $user = $this->getTestingUser();

        $data = [
            'name'     => 'Updated Name',
            'password' => 'updated#Password',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // assert returned user is the updated one
        $this->assertResponseContainKeyValue([
            'email' => $user->email,
            'name'  => $data['name'],
        ]);

        // assert data was updated in the database
        $this->assertDatabaseHas('users', ['name' => $data['name']]);
    }

    public function testUpdateExistingUserWithoutData_()
    {
        $data = [];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(417);
    }


    public function testUpdateExistingUserWithEmptyValues()
    {
        $data = []; // empty data

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(417);

        // assert message is correct
        $this->assertResponseContainKeyValue([
            'message' => 'Inputs are empty.',
        ]);
    }
}
