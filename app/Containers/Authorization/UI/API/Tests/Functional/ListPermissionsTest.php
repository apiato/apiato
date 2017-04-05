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

    protected $endpoint = 'get@v1/permissions';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-roles',
    ];

    public function testListAllPermissions_()
    {
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $this->assertTrue(count($responseContent->data) > 0);
    }

}
