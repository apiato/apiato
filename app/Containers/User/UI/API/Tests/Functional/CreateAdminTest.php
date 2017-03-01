<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Tests\TestCase;

/**
 * Class CreateAdminTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateAdminTest extends TestCase
{

    protected $endpoint = 'post@admins';

    protected $access = [
        'permissions' => '',
        'roles'       => 'admin',
    ];

    public function testCreateAdmin_()
    {
        $data = [
            'email'    => 'hello@admin.dev',
            'name'     => 'admin',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $this->assertResponseContainKeyValue([
            'email' => $data['email'],
            'name'  => $data['name'],
        ], $response);

         // assert response contain the token
        $this->assertResponseContainKeys(['id', 'token'], $response);

         // assert the data is stored in the database
        $this->seeInDatabase('users', ['email' => $data['email']]);

        $responseContent = $this->getResponseContent($response);

        $this->assertEquals($responseContent->data->roles->data[0]->name, $data['name']);
    }

}
