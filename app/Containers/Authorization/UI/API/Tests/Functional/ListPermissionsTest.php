<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\User;
use App\Containers\Authorization\Tests\TestCase;

/**
 * Class ListPermissionsTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListPermissionsTest extends TestCase
{

    protected $endpoint = '/permissions';

    protected $access = [
        'roles'       => 'admin',
        'permissions' => '',
    ];

    public function testListAllPermissions_()
    {
        $this->getTestingAdmin();

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get');

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        // convert JSON response string to Object
        $responseObject = $this->getResponseObject($response);

        $this->assertTrue(count($responseObject->data) > 0);
    }

}
