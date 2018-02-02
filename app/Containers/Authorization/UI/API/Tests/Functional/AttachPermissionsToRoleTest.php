<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\ApiTestCase;

/**
 * Class AttachPermissionsToRoleTest.
 *
 * @group authorization
 * @group api
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class AttachPermissionsToRoleTest extends ApiTestCase
{

    protected $endpoint = 'post@v1/permissions/attach';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-roles',
    ];

    /**
     * @test
     */
    public function testAttachSinglePermissionToRole_()
    {
        $roleA = factory(Role::class)->create();
        $permissionA = factory(Permission::class)->create();

        $data = [
            'role_id'         => $roleA->getHashedKey(),
            'permissions_ids' => $permissionA->getHashedKey(),
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($roleA['name'], $responseContent->data->name);

        $this->assertDatabaseHas('role_has_permissions', [
            'permission_id' => $permissionA->id,
            'role_id'       => $roleA->id
        ]);
    }

    public function testAttachMultiplePermissionToRole_()
    {
        $roleA = factory(Role::class)->create();

        $permissionA = factory(Permission::class)->create();
        $permissionB = factory(Permission::class)->create();

        $data = [
            'role_id'         => $roleA->getHashedKey(),
            'permissions_ids' => [$permissionA->getHashedKey(), $permissionB->getHashedKey()]
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertDatabaseHas('role_has_permissions', [
            'permission_id' => $permissionA->id,
            'permission_id' => $permissionB->id,
            'role_id'       => $roleA->id
        ]);

    }

}
