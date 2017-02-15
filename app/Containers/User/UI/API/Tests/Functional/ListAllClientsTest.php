<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;

/**
 * Class ListAllUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllClientsTest extends TestCase
{

    protected $endpoint = '/clients';

    protected $access = [
        'roles'       => 'admin',
        'permissions' => 'list-users',
    ];

    public function testListAllClientsByAdmin_()
    {
        $this->getTestingAdmin();

        // create some non-admin users who are clients
        factory(User::class)->create()->assignRole('client');
        factory(User::class)->create()->assignRole('client');

        factory(User::class)->create();

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get');

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        // convert JSON response string to Object
        $responseObject = $this->getResponseObject($response);

        // assert the returned data size is correct
        $this->assertCount(2, $responseObject->data);
    }

}
