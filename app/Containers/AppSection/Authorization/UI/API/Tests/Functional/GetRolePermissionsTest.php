<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;

/**
 * Class GetRolePermissionsTest.
 *
 * @group authorization
 * @group api
 */
class GetRolePermissionsTest extends ApiTestCase
{
    // the endpoint to be called within this test (e.g., get@v1/users)
    protected string $endpoint = 'get@v1/roles/{id}/permissions';

    // fake some access rights
    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    public function testGetRolePermissions(): void
    {
        $role = Role::factory()->create();
        $permission = Permission::factory()->create();
        $role->givePermissionTo([$permission]);
        // send the HTTP request
        $response = $this->injectId($role->id)->makeCall();
        // assert the response status
        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        $this->assertEquals($permission->name, $responseContent->data[0]->name);

    }
}
