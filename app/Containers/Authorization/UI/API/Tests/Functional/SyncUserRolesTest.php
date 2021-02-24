<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\ApiTestCase;
use App\Containers\User\Models\User;
use Illuminate\Support\Arr;

/**
 * Class SyncUserRolesTest.
 *
 * @group authorization
 * @group api
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class SyncUserRolesTest extends ApiTestCase
{
    protected $endpoint = 'post@v1/roles/sync?include=roles';

    protected $access = [
        'roles' => '',
        'permissions' => 'manage-admins-access',
    ];

    public function testSyncMultipleRolesOnUser(): void
    {
        $role1 = Role::factory()->create(['display_name' => '111']);
        $role2 = Role::factory()->create(['display_name' => '222']);

        $randomUser = User::factory()->create();
        $randomUser->assignRole($role1);


        $data = [
            'roles_ids' => [
                $role1->getHashedKey(),
                $role2->getHashedKey(),
            ],
            'user_id' => $randomUser->getHashedKey(),
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertTrue(count($responseContent->data->roles->data) > 1);

        $roleIds = Arr::pluck($responseContent->data->roles->data, 'id');
        $this->assertContains($data['roles_ids'][0], $roleIds);

        $this->assertContains($data['roles_ids'][1], $roleIds);
    }
}
