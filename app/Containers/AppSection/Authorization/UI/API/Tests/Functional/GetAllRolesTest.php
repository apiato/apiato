<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;

/**
 * Class GetAllRolesTest.
 *
 * @group authorization
 * @group api
 */
class GetAllRolesTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/roles';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => '',
    ];

    public function testGetAllRoles(): void
    {
        $this->getTestingUser();

        $response = $this->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        $this->assertNotEmpty($responseContent->data);
    }
}
