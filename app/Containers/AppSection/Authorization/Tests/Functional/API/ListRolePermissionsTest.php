<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversNothing]
final class ListRolePermissionsTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/roles/{id}/permissions';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => null,
    ];

    public function testGetRolePermissions(): void
    {
        $role = RoleFactory::new()->createOne();
        $permission = PermissionFactory::new()->createOne();
        $role->givePermissionTo([$permission]);

        $response = $this->injectId($role->id)->makeCall();

        $response->assertOk();
        $responseContent = $this->getResponseContentObject();
        $this->assertSame($permission->name, $responseContent->data[0]->name);
    }
}
