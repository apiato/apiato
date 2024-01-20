<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversNothing]
final class AttachPermissionToUserTest extends ApiTestCase
{
    protected string $endpoint = 'patch@v1/users/{id}/permissions';

    protected array $access = [
        'permissions' => 'manage-permissions',
        'roles' => null,
    ];

    public function testAttachSinglePermissionToUser(): void
    {
        $user = UserFactory::new()->createOne();

        $permission = PermissionFactory::new()->createOne();
        $data = [
            'permissions_ids' => [$permission->id],
        ];

        // send the HTTP request
        $response = $this->injectId($user->id)->makeCall($data);

        // assert the response status
        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                ->where('data.object', 'User')
                ->where('data.id', $user->getHashedKey())
                ->has('data.permissions.data', 1)
                ->where('data.permissions.data.0.object', 'Permission')
                ->where('data.permissions.data.0.id', $permission->getHashedKey())
                ->etc(),
        );
    }

    public function testAttachMultiplePermissionsToUser(): void
    {
        $user = UserFactory::new()->createOne();
        $permissionA = PermissionFactory::new()->createOne();
        $permissionB = PermissionFactory::new()->createOne();
        $data = [
            'permissions_ids' => [$permissionA->id, $permissionB->id],
        ];

        $response = $this->injectId($user->id)->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                ->where('data.object', 'User')
                ->where('data.id', $user->getHashedKey())
                ->has('data.permissions.data', 2)
                ->where('data.permissions.data.0.object', 'Permission')
                ->where('data.permissions.data.0.id', $permissionA->getHashedKey())
                ->where('data.permissions.data.1.id', $permissionB->getHashedKey())
                ->etc(),
        );
    }

    public function testAttachNonExistingPermissionToUser(): void
    {
        $user = UserFactory::new()->createOne();
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
                    fn (AssertableJson $permissionsIds) => $permissionsIds->where(0, 'The selected permissions_ids.0 is invalid.'),
                )->etc(),
            )->etc(),
        );
    }

    public function testAttachPermissionToNonExistingUser(): void
    {
        $permission = PermissionFactory::new()->createOne();
        $invalidId = 7777;
        $data = [
            'permissions_ids' => [$permission->id],
        ];

        $response = $this->injectId($invalidId)->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('errors')
                ->where('errors.id.0', 'The selected id is invalid.')
                ->etc(),
        );
    }
}
