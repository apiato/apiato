<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Models\User;
use App\Containers\Authorization\Models\Role;
use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class ListAllUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllUsersTest extends TestCase
{

    private $endpoint = '/users';

    public function testListAllUsersByAdmin_()
    {
        $user = $this->getLoggedInTestingUser();

        // get the admin role
        $adminRole = Role::where('name', 'admin')->first();

        // make the user admin
        $user->attachRole($adminRole);

        // create some non-admin users
        factory(User::class, 4)->create();

        $endpoint = $this->endpoint;

        // send the HTTP request
        $response = $this->apiCall($endpoint, 'get');

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        // convert JSON response string to Array
        $responseArray = json_decode($response->getContent());

        // assert the returned data size is correct
        $this->assertCount(5, $responseArray->data); // 5 = 4 (fake in this test) + 1 (that is logged in)
    }

    public function testListAllUsersByNonAdmin_()
    {
        // create some fake users
        factory(User::class, 4)->create();

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get');

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '403');
    }

}
