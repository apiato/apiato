<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\User;
use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class ListRolesTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListRolesTest extends TestCase
{

    private $endpoint = '/roles';

    public function testListAllRoles_()
    {
        $admin = $this->getLoggedInTestingAdmin();

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get');

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        // convert JSON response string to Object
        $responseObject = $this->getResponseObject($response);

        $this->assertTrue(count($responseObject->data) > 0);
    }

}
