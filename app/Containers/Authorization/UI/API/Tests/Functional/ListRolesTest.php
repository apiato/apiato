<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\User;
use App\Containers\Authorization\Tests\TestCase;

/**
 * Class ListRolesTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListRolesTest extends TestCase
{

    protected $endpoint = 'get@roles';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-roles',
    ];

    public function testListAllRoles_()
    {
        $this->getTestingUser();

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        // convert JSON response string to Object
        $responseContent = $this->getResponseContent($response);

        $this->assertTrue(count($responseContent->data) > 0);
    }

}
