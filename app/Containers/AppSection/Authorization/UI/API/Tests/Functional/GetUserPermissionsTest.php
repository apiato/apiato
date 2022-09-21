<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;
use App\Containers\AppSection\User\Models\User;

/**
 * Class GetUserPermissionsTest.
 *
 * @group authorization
 * @group api
 */
class GetUserPermissionsTest extends ApiTestCase
{
    // the endpoint to be called within this test (e.g., get@v1/users)
    protected string $endpoint = 'get@v1/users/{id}/permissions';

    // fake some access rights
    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    public function testGetUserPermissions(): void
    {
        $user = User::factory()->create();
        $permission = Permission::factory()->create();
        $user->givePermissionTo([$permission]);
        // send the HTTP request
        $response = $this->injectId($user->id)->makeCall();

        // assert the response status
        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        $this->assertEquals($permission->name, $responseContent->data[0]->name);

    }
}
