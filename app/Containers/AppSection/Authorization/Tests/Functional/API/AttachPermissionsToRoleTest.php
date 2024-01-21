<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversNothing]
final class AttachPermissionsToRoleTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/permissions/attach';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => null,
    ];

    public function testAttachSinglePermissionToRole(): void
    {
        $role = RoleFactory::new()->createOne();
        $permission = PermissionFactory::new()->createOne();
        $data = [
            'role_id' => $role->getHashedKey(),
            'permissions_ids' => $permission->getHashedKey(),
        ];

        $response = $this->endpoint($this->endpoint . '?include=permissions')->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                ->where('data.object', 'Role')
                ->where('data.id', $role->getHashedKey())
                ->has('data.permissions.data', 1)
                ->where('data.permissions.data.0.object', 'Permission')
                ->where('data.permissions.data.0.id', $permission->getHashedKey())
                ->etc(),
        );
    }

    public function testAttachMultiplePermissionsToRole(): void
    {
        $role = RoleFactory::new()->createOne();
        $permissionA = PermissionFactory::new()->createOne();
        $permissionB = PermissionFactory::new()->createOne();
        $data = [
            'role_id' => $role->getHashedKey(),
            'permissions_ids' => [$permissionA->getHashedKey(), $permissionB->getHashedKey()],
        ];

        $response = $this->endpoint($this->endpoint . '?include=permissions')->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                ->where('data.object', 'Role')
                ->where('data.id', $role->getHashedKey())
                ->has('data.permissions.data', 2)
                ->etc(),
        );
    }

    public function testAttachNonExistingPermissionToRole(): void
    {
        $role = RoleFactory::new()->createOne();
        $invalidId = 7777;
        $data = [
            'role_id' => $role->getHashedKey(),
            'permissions_ids' => [$this->encode($invalidId)],
        ];

        $response = $this->makeCall($data);

        $response->assertUnprocessable();
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

    public function testAttachPermissionToNonExistingRole(): void
    {
        $permission = PermissionFactory::new()->createOne();
        $invalidId = 7777;
        $data = [
            'role_id' => $this->encode($invalidId),
            'permissions_ids' => [$permission->getHashedKey()],
        ];

        $response = $this->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('errors')
                ->where('errors.role_id.0', 'The selected role id is invalid.')
                ->etc(),
        );
    }
}
