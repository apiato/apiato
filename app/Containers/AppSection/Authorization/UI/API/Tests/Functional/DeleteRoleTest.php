<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;

/**
 * Class DeleteRoleTest.
 *
 * @group authorization
 * @group api
 */
class DeleteRoleTest extends ApiTestCase
{
    protected string $endpoint = 'delete@v1/roles/{id}';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => '',
    ];

    public function testDeleteExistingRole(): void
    {
        $role = Role::factory()->create();

        $response = $this->injectId($role->id)->makeCall();

        $response->assertStatus(204);
    }

    public function testDeleteNonExistingRole(): void
    {
        $invalidId = 7777;

        $response = $this->injectId($invalidId)->makeCall([]);

        $response->assertStatus(404);
    }
}
