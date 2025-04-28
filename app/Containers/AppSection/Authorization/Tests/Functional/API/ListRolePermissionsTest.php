<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class ListRolePermissionsTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/roles/{role_id}/permissions';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles'       => null,
    ];

    public function testGetRolePermissions(): void
    {
        $model = RoleFactory::new()->createOne();
        $permission = PermissionFactory::new()->createOne();
        $model->givePermissionTo([$permission]);

        $testResponse = $this->injectId($model->id, replace: '{role_id}')->makeCall();

        $testResponse->assertOk();

        $responseContent = $this->getResponseContentObject();
        $this->assertSame($permission->name, $responseContent->data[0]->name);
    }
}
