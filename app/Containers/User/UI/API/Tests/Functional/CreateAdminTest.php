<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class CreateAdminTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateAdminTest extends TestCase
{

    private $endpoint = '/admins/create';

    public function testCreateAdmin_()
    {

        $admin = $this->getLoggedInTestingAdmin();

        $data = [
            'email'    => 'hello@admin.dev',
            'name'     => 'admin',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        $this->assertResponseContainKeyValue([
            'email' => $data['email'],
            'name'  => $data['name'],
        ], $response);

         // assert response contain the token
        $this->assertResponseContainKeys(['id', 'token'], $response);

         // assert the data is stored in the database
        $this->seeInDatabase('users', ['email' => $data['email']]);

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($responseObject->data->roles->data[0]->name, $data['name']);
    }

}
