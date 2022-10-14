<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

/**
 * Class AttachPermissionToUserTest.
 *
 * @group authorization
 * @group api
 */
class AttachPermissionToUserTest extends ApiTestCase
{
    // the endpoint to be called within this test (e.g., get@v1/users)
    protected string $endpoint = 'patch@v1/users/{id}/permissions';

    // fake some access rights
    protected array $access = [
        'permissions' => 'manage-permissions',
        'roles' => '',
    ];

    public function testAttachSinglePermissionToUser(): void
    {
        $user = User::factory()->create();

        $permission = Permission::factory()->create();
        $data = [
            'permissions_ids' => [$permission->id],
        ];

        // send the HTTP request
        $response = $this->injectId($user->id)->makeCall($data);

        // assert the response status
        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                ->where('data.object', 'User')
                ->where('data.id', $user->getHashedKey())
                ->has('data.permissions.data', 1)
                ->where('data.permissions.data.0.object', 'Permission')
                ->where('data.permissions.data.0.id', $permission->getHashedKey())
                ->etc()
        );
    }

    public function testAttachMultiplePermissionsToUser(): void
    {
        $user = User::factory()->create();
        $permissionA = Permission::factory()->create();
        $permissionB = Permission::factory()->create();
        $data = [
            'permissions_ids' => [$permissionA->id, $permissionB->id],
        ];

        $response = $this->injectId($user->id)->makeCall($data);

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                ->where('data.object', 'User')
                ->where('data.id', $user->getHashedKey())
                ->has('data.permissions.data', 2)
                ->where('data.permissions.data.0.object', 'Permission')
                ->where('data.permissions.data.0.id', $permissionA->getHashedKey())
                ->where('data.permissions.data.1.id', $permissionB->getHashedKey())
                ->etc()
        );
    }

    public function testAttachNonExistingPermissionToUser(): void
    {
        $user = User::factory()->create();
        $invalidId = 3333;
        $data = [
            'permissions_ids' => [$invalidId],
        ];

        $response = $this->injectId($user->id)->makeCall($data);

        $response->assertJson(
            fn (AssertableJson $json) => $json->has(
                'errors',
                fn (AssertableJson $errors) => $errors->has(
                    'permissions_ids.0',
                    fn (AssertableJson $permissionsIds) => $permissionsIds->where(0, 'The selected permissions_ids.0 is invalid.')
                )->etc()
            )->etc()
        );
    }

    public function testAttachPermissionToNonExistingUser(): void
    {
        $permission = Permission::factory()->create();
        $invalidId = 7777;
        $data = [
            'permissions_ids' => [$permission->id],
        ];

        $response = $this->injectId($invalidId)->makeCall($data);

        $response->assertStatus(422);
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('errors')
                ->where('errors.id.0', 'The selected id is invalid.')
                ->etc()
        );
    }
}
