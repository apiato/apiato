<?php

namespace Mega\Modules\User\Tests\Api;

use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mega\Modules\User\Models\User;
use Mega\Services\Core\Test\Abstracts\TestCase;

/**
 * Class ListAllUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllUsersTest extends TestCase
{

    use DatabaseMigrations;

    private $endpoint = '/users';

    public function testListAllUsers_()
    {
        // create some fake users
        factory(User::class, 4)->create();

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get');

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        // convert JSON response string to Array
        $responseArray = json_decode($response->getContent());

        // assert the returned data size is correct
        $this->assertCount(5, $responseArray->data); // 5 = 4 (fake in this test) + 1 (that is logged in)
    }

    public function testListAllUsersOnlyForAdmin_()
    {
        // TODO: seed the roles and permissions for every class

        // TODO: Add roles and permissions here..

        // create some fake users
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
}
