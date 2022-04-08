<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;

/**
 * Class FindPermissionTest.
 *
 * @group authorization
 * @group api
 */
class FindPermissionTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/permissions/{id}';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => '',
    ];

    public function testFindPermissionById(): void
    {
        $permissionA = Permission::factory()->create();

        $response = $this->injectId($permissionA->id)->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        $this->assertEquals($permissionA->name, $responseContent->data->name);
    }

    public function testFindNonExistingPermission(): void
    {
        $invalidId = 7777;

        $response = $this->injectId($invalidId)->makeCall([]);

        $response->assertStatus(404);
    }
}
