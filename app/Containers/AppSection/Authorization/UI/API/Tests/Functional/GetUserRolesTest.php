<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;
use App\Containers\AppSection\User\Models\User;

/**
 * @group authorization
 * @group api
 */
class GetUserRolesTest extends ApiTestCase
{
    // the endpoint to be called within this test (e.g., get@v1/users)
    protected string $endpoint = 'get@v1/users/{id}/roles';

    // fake some access rights
    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    public function testGetUserRoles(): void
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();
        $user->assignRole($role);
        // send the HTTP request
        $response = $this->injectId($user->id)->makeCall();

        // assert the response status
        $response->assertOk();
        $responseContent = $this->getResponseContentObject();
        $this->assertEquals($role->name, $responseContent->data[0]->name);
    }
}
