<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class DetachPermissionFromUserTest.
 *
 * @group authorization
 * @group api
 */
class DetachPermissionFromUserTest extends ApiTestCase
{
    // the endpoint to be called within this test (e.g., get@v1/users)
    protected string $endpoint = 'post@v1/users/{id}/permissions/detach';

    // fake some access rights
    protected array $access = [
        'permissions' => 'manage-permissions',
        'roles' => '',
    ];


    public function testDetachSinglePermissionFromUser(): void
    {
        $user = User::factory()->create();
        $permissionA = Permission::factory()->create();
        $permissionB = Permission::factory()->create();
        $user->givePermissionTo([$permissionA, $permissionB]);

        $data = [
            'permissions_ids' => [$permissionA->id]
        ];

        // send the HTTP request
        $response = $this->injectId($user->id)->makeCall($data);
        // assert the response status
        $response->assertStatus(200);
        $response->assertJson(
            fn(AssertableJson $json) => $json->has('data')
                ->where('data.object', 'User')
                ->where('data.id', $user->getHashedKey())
                ->has('data.permissions.data',1)
                ->where('data.permissions.data.0.object', 'Permission')
                ->where('data.permissions.data.0.id', $permissionB->getHashedKey())
                ->etc()
        );
    }

    public function testDetachMultiplePermissionFromUser(): void
    {
        $user = User::factory()->create();
        $permissionA = Permission::factory()->create();
        $permissionB = Permission::factory()->create();
        $permissionC = Permission::factory()->create();

        $user->givePermissionTo([$permissionA, $permissionB, $permissionC]);

        $data = [
            'permissions_ids' => [$permissionA->id, $permissionB->id]
        ];

        // send the HTTP request
        $response = $this->injectId($user->id)->makeCall($data);

        // assert the response status
        $response->assertStatus(200);
        $response->assertJson(
            fn(AssertableJson $json) => $json->has('data')
                ->where('data.object', 'User')
                ->where('data.id', $user->getHashedKey())
                ->count('data.permissions.data', 1)
                ->where('data.permissions.data.0.id', $permissionC->getHashedKey())
                ->etc()
        );
    }

    public function testDetachNonExistingPermissionFromUser()
    {
        $invalidId = 3333;
        $user = User::factory()->create();
        $data = [
            'permissions_ids' => [Hashids::encode($invalidId)]
        ];

        $response = $this->injectId($user->id)->makeCall($data);

        $response->assertStatus(404);
    }

    public function testDetachPermissionFromNonExistingUser()
    {
        $invalidId = 3333;
        $permission = Permission::factory()->create();
        $data = [
            //'user_id' => Hashids::encode($invalidId),
            'permissions_ids' => [$permission->getHashedKey()]
        ];

        $response = $this->injectId($invalidId)->makeCall($data);

        $response->assertStatus(404);
    }
}
