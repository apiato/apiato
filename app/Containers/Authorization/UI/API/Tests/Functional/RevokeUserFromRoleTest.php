<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Role;
use App\Containers\User\Models\User;
use App\Containers\Authorization\Tests\TestCase;

/**
 * Class RevokeUserFromRoleTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class RevokeUserFromRoleTest extends TestCase
{

    protected $endpoint = '/roles/revoke';

    protected $access = [
        'roles'       => 'admin',
        'permissions' => '',
    ];

    public function setUp()
    {
        putenv('HASH_ID=true');
        parent::setup();
    }

    public function testRevokeUserFromRole_()
    {
        $admin = $this->getTestingAdmin();

        $data = [
            'roles_names' => 'admin',
            'user_id'     => $admin->getHashedKey(),
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($data['user_id'], $responseObject->data->id);

        $this->missingFromDatabase('user_has_roles', [
            'user_id' => $admin->id,
            'role_id' => 2, // for admin, manually setting it now
        ]);
    }

    public function testRevokeUserFromRoleWithRealId_()
    {
        $admin = $this->getTestingAdmin();

        $data = [
            'roles_names' => 'admin',
            'user_id'     => $admin->id,
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct. Note: this will return 200 if `HASH_ID=false` in the .env
        $this->assertEquals('400', $response->getStatusCode());

        $this->assertResponseContainKeyValue([
            'message' => 'Only Hashed ID\'s allowed to be passed.',
        ], $response);
    }

    public function testRevokeUserFromManyRoles_()
    {
        $this->getTestingUser();

        $randomUser = factory(User::class)->create();

        $roleA = Role::create([
            'name'         => 'role-A',
            'description'  => 'AA',
            'display_name' => 'A',
        ]);

        $roleB = Role::create([
            'name'         => 'role-B',
            'description'  => 'BB',
            'display_name' => 'B',
        ]);

        $randomUser->assignRole($roleA);
        $randomUser->assignRole($roleB);

        $data = [
            'roles_names' => ['role-A', 'role-B'],
            'user_id'     => $randomUser->getHashedKey(),
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $this->missingFromDatabase('user_has_roles', [
            'user_id' => $randomUser->id,
            'role_id' => $roleB->id,
            'role_id' => $roleA->id,
        ]);

    }

}
