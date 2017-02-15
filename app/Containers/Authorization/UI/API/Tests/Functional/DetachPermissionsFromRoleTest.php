<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\TestCase;

/**
 * Class DetachPermissionsFromRoleTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class DetachPermissionsFromRoleTest extends TestCase
{

    protected $endpoint = '/permissions/detach';

    protected $access = [
        'roles'       => 'admin',
        'permissions' => '',
    ];

    public function testDetachSinglePermissionFromRole_()
    {
        $this->getTestingAdmin();

        $permissionA = Permission::create([
            'name'         => 'permission-A',
            'description'  => 'AA',
            'display_name' => 'A',
        ]);

        $roleA = Role::create([
            'name'         => 'role-A',
            'description'  => 'AA',
            'display_name' => 'A',
        ]);

        $roleA->givePermissionTo($permissionA);

        $data = [
            'role_name'       => $roleA['name'],
            'permission_name' => $permissionA['name'],
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($roleA['name'], $responseObject->data->name);

        $this->missingFromDatabase('role_has_permissions', [
            'permission_id' => $permissionA->id,
            'role_id'       => $roleA->id
        ]);
    }

    public function testDetachMultiplePermissionFromRole_()
    {
        $this->getTestingAdmin();

        $permissionA = Permission::create([
            'name'         => 'permission-A',
            'description'  => 'AA',
            'display_name' => 'A',
        ]);

        $permissionB = Permission::create([
            'name'         => 'permission-B',
            'description'  => 'BB',
            'display_name' => 'B',
        ]);

        $roleA = Role::create([
            'name'         => 'role-A',
            'description'  => 'AA',
            'display_name' => 'A',
        ]);

        $roleA->givePermissionTo($permissionA);
        $roleA->givePermissionTo($permissionB);

        $data = [
            'role_name'       => $roleA['name'],
            'permission_name' => [$permissionA['name'], $permissionB['name']]
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $responseObject = $this->getResponseObject($response);

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($roleA['name'], $responseObject->data->name);

        $this->missingFromDatabase('role_has_permissions', [
            'permission_id' => $permissionA->id,
            'permission_id' => $permissionB->id,
            'role_id'       => $roleA->id
        ]);
    }


}
