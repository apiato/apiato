<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\TestCase;
use App\Containers\User\Models\User;

/**
 * Class AssignUserToRoleTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class AssignUserToRoleTest extends TestCase
{

    protected $endpoint = 'post@roles/assign';

    protected $access = [
        'roles'       => 'admin',
        'permissions' => '',
    ];

    public function testAssignUserToRole_()
    {
        $randomUser = factory(User::class)->create();

        $role = factory(Role::class)->create();

        $data = [
            'roles_ids' => $role->getHashedKey(),
            'user_id'   => $randomUser->getHashedKey(),
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $responseContent = $this->getResponseContent($response);

        $this->assertEquals($data['user_id'], $responseContent->data->id);

        $this->assertEquals($data['roles_ids'], $responseContent->data->roles->data[0]->id);
    }

    public function testAssignUserToRoleWithRealId_()
    {
        $randomUser = factory(User::class)->create();

        $role = factory(Role::class)->create();

        $data = [
            'roles_ids' => $role->id,
            'user_id'   => $randomUser->id,
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct. Note: this will return 200 if `HASH_ID=false` in the .env
        $this->assertEquals('400', $response->getStatusCode());

        $this->assertResponseContainKeyValue([
            'message' => 'Only Hashed ID\'s allowed to be passed.',
        ], $response);
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
        $this->assertEquals('200', $response->getStatusCode());

        $responseContent = $this->getResponseContent($response);

        $this->assertTrue(count($responseContent->data->roles->data) > 1);

        $this->assertEquals($data['roles_ids'][0], $responseContent->data->roles->data[0]->id);

        $this->assertEquals($data['roles_ids'][1], $responseContent->data->roles->data[1]->id);
    }

}
