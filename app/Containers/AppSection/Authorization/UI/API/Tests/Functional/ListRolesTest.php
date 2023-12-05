<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;

/**
 * @group authorization
 * @group api
 */
class ListRolesTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/roles';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => '',
    ];

    public function testListRoles(): void
    {
        $this->getTestingUser();

        $response = $this->makeCall();

        $response->assertOk();
        $responseContent = $this->getResponseContentObject();
        $this->assertNotEmpty($responseContent->data);
    }
}
