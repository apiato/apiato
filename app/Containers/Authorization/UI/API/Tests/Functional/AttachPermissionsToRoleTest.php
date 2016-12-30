<?php

namespace App\Containers\Order\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Models\Role;
use App\Containers\User\Models\User;
use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class AttachPermissionsToRoleTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class AttachPermissionsToRoleTest extends TestCase
{

    private $endpoint = '/permissions/attach';

    public function testAttachSinglePermissionToRole_()
    {
        $admin = $this->getLoggedInTestingAdmin();

        $roleA = Role::create([
            'name'         => 'role-A',
            'description'  => 'AA',
            'display_name' => 'A',
        ]);

        $permissionA = Permission::create([
            'name'         => 'permission-A',
            'description'  => 'AA',
            'display_name' => 'A',
        ]);

        $data = [
            'role_name' => $roleA['name'],
            'permission_name' => $permissionA['name'],
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($roleA['name'], $responseObject->data->name);
    }

    public function testAttachMultiplePermissionToRole_()
    {
        $admin = $this->getLoggedInTestingAdmin();

        $roleA = Role::create([
            'name'         => 'role-A',
            'description'  => 'AA',
            'display_name' => 'A',
        ]);

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


        $data = [
            'role_name' => $roleA['name'],
            'permission_name' => [$permissionA['name'], $permissionB['name']]
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

    }


}
