<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\TestCase;
use App\Containers\User\Models\User;
use Illuminate\Support\Facades\Config;

/**
 * Class AssignUserToRoleTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class AssignUserToRoleTest extends TestCase
{

    protected $endpoint = 'post@v1/roles/assign?include=roles';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-admins-access',
    ];

    public function testAssignUserToRole_()
    {
        $randomUser = factory(User::class)->create();

        $role = factory(Role::class)->create();

        $data = [
            'roles_ids' => [$role->getHashedKey()],
            'user_id'   => $randomUser->getHashedKey(),
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['user_id'], $responseContent->data->id);

        $this->assertEquals($data['roles_ids'][0], $responseContent->data->roles->data[0]->id);
    }

    public function testAssignUserToRoleWithRealId_()
    {
        $randomUser = factory(User::class)->create();

        $role = factory(Role::class)->create();

        $data = [
            'roles_ids' => [$role->id], // testing against real ID's
            'user_id'   => $randomUser->id, // testing against real ID's
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct. Note: this will return 200 if `HASH_ID=false` in the .env
        if(Config::get('apiato.hash-id')){
            $response->assertStatus(400);

            $this->assertResponseContainKeyValue([
                'message' => 'Only Hashed ID\'s allowed.',
            ]);
        }else{
            $response->assertStatus(200);
        }

    }

    public function testAssignUserToManyRoles_()
    {
        $randomUser = factory(User::class)->create();

        $role1 = factory(Role::class)->create();
        $role2 = factory(Role::class)->create();

        $data = [
            'roles_ids' => [
                $role1->getHashedKey(),
                $role2->getHashedKey(),
            ],
            'user_id'   => $randomUser->getHashedKey(),
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertTrue(count($responseContent->data->roles->data) > 1);

        $roleIds = array_pluck($responseContent->data->roles->data, 'id');
        $this->assertContains($data['roles_ids'][0], $roleIds);

        $this->assertContains($data['roles_ids'][1], $roleIds);
    }

}
