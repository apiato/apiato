<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Tests\ApiTestCase;

/**
 * Class GetAllRolesTest.
 *
 * @group authorization
 * @group api
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllRolesTest extends ApiTestCase
{

    protected $endpoint = 'get@v1/roles';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-roles',
    ];

    /**
     * @test
     */
    public function testGetAllRoles_()
    {
        $this->getTestingUser();

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $this->assertTrue(count($responseContent->data) > 0);
    }

}
