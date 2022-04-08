<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;

/**
 * Class GetAllPermissionsTest.
 *
 * @group authorization
 * @group api
 */
class GetAllPermissionsTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/permissions';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => '',
    ];

    public function testGetAllPermissions(): void
    {
        $response = $this->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        $this->assertNotEmpty($responseContent->data);
    }
}
