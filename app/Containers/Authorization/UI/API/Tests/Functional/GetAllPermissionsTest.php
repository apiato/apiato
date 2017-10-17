<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Tests\TestCase;

/**
 * Class GetAllPermissionsTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllPermissionsTest extends TestCase
{

    protected $endpoint = 'get@v1/permissions';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-roles',
    ];

    public function testGetAllPermissions_()
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
