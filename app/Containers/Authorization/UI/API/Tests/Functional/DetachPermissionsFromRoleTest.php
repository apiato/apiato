<?php
//
//namespace App\Containers\Authorization\UI\API\Tests\Functional;
//
//use App\Containers\Authorization\Models\Permission;
//use App\Containers\Authorization\Models\Role;
//use App\Containers\Authorization\Tests\TestCase;
//
///**
// * Class DetachPermissionsFromRoleTest.
// *
// * @author  Mahmoud Zalt <mahmoud@zalt.me>
// */
//class DetachPermissionsFromRoleTest extends TestCase
//{
//
//    protected $endpoint = 'post@v1/permissions/detach';
//
//    protected $access = [
//        'roles'       => '',
//        'permissions' => 'manage-roles',
//    ];
//
//    public function testDetachSinglePermissionFromRole_()
//    {
//        $permissionA = factory(Permission::class)->create();
//
//        $roleA = factory(Role::class)->create();
//        $roleA->givePermissionTo($permissionA);
//
//        $data = [
//            'role_id'         => $roleA->getHashedKey(),
//            'permissions_ids' => [$permissionA->getHashedKey()],
//        ];
//
//        // send the HTTP request
//        $response = $this->makeCall($data);
//
//        $response->assertStatus(200);
//
//        $responseContent = $this->getResponseContentObject();
//
//        $this->assertEquals($roleA->name, $responseContent->data->name);
//
//        $this->assertDatabaseMissing('role_has_permissions', [
//            'permission_id' => $permissionA->id,
//            'role_id'       => $roleA->id
//        ]);
//    }
//
//    public function testDetachMultiplePermissionFromRole_()
//    {
//        $permissionA = factory(Permission::class)->create();
//        $permissionB = factory(Permission::class)->create();
//
//        $roleA = factory(Role::class)->create();
//        $roleA->givePermissionTo($permissionA);
//        $roleA->givePermissionTo($permissionB);
//
//        $data = [
//            'role_id'         => $roleA->getHashedKey(),
//            'permissions_ids' => [$permissionA->getHashedKey(), $permissionB->getHashedKey()],
//        ];
//
//        // send the HTTP request
//        $response = $this->makeCall($data);
//
//        $response->assertStatus(200);
//
//        $responseContent = $this->getResponseContentObject();
//
//        $this->assertEquals($roleA->name, $responseContent->data->name);
//
//        $this->assertDatabaseMissing('role_has_permissions', [
//            'permission_id' => $permissionA->id,
//            'permission_id' => $permissionB->id,
//            'role_id'       => $roleA->id
//        ]);
//    }
//
//
//}
