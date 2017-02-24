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

    protected $endpoint = 'get@permissions';

    protected $access = [
        'roles'       => 'admin',
        'permissions' => '',
    ];

    public function testListAllPermissions_()
    {
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        // convert JSON response string to Object
        $responseObject = $this->getResponseObject($response);

        $this->assertTrue(count($responseObject->data) > 0);
    }

}
