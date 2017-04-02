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

    protected $endpoint = 'get@clients';

    protected $access = [
        'roles'       => '',
        'permissions' => 'list-users',
    ];

    public function testListAllClientsByAdmin_()
    {
        factory(User::class, 2)->create();

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        // assert the returned data size is correct
        $this->assertCount(4, $responseContent->data); // TODO: needs to be 2 only.
    }

}
