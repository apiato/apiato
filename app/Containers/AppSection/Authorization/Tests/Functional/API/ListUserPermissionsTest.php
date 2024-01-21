<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversNothing]
final class ListUserPermissionsTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/users/{id}/permissions';

    protected array $access = [
        'permissions' => 'manage-permissions',
        'roles' => null,
    ];

    public function testGetUserPermissions(): void
    {
        $user = UserFactory::new()->createOne();
        $permission = PermissionFactory::new()->createOne();
        $user->givePermissionTo([$permission]);

        $response = $this->injectId($user->id)->makeCall();

        $response->assertOk();
        $responseContent = $this->getResponseContentObject();
        $this->assertSame($permission->name, $responseContent->data[0]->name);
    }
}
