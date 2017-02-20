<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\TestCase;

/**
 * Class SyncPermissionsOnRoleTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class SyncPermissionsOnRoleTest extends TestCase
{

    protected $endpoint = '/permissions/sync';

    protected $access = [
        'roles'       => 'admin',
        'permissions' => '',
    ];

    public function testSyncDuplicatedPermissionsToRole_()
    {
        $this->getTestingAdmin();

        $permissionA = factory(Permission::class)->create(['display_name' => 'AAA']);
        $permissionB = factory(Permission::class)->create(['display_name' => 'BBB']);

        $roleA = factory(Role::class)->create();
        $roleA->givePermissionTo($permissionA);

        $data = [
            'role_id'         => $roleA->getHashedKey(),
            'permissions_ids' => [$permissionA->getHashedKey(), $permissionB->getHashedKey()]
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $this->seeInDatabase('role_has_permissions', [
            'permission_id' => $permissionA->id,
            'permission_id' => $permissionB->id,
            'role_id'       => $roleA->id
        ]);

    }

}
