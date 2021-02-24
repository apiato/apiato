<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\ApiTestCase;

/**
 * Class DeleteRoleTest.
 *
 * @group authorization
 * @group api
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteRoleTest extends ApiTestCase
{
    protected $endpoint = 'delete@v1/roles/{id}';

    protected $access = [
        'roles' => '',
        'permissions' => 'manage-roles',
    ];

    public function testDeleteExistingRole_(): void
    {
        $role = Role::factory()->create();

        // send the HTTP request
        $response = $this->injectId($role->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(204);
    }

}
