<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversNothing]
final class ListUserRolesTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/users/{id}/roles';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => null,
    ];

    public function testGetUserRoles(): void
    {
        $user = UserFactory::new()->createOne();
        $role = RoleFactory::new()->createOne();
        $user->assignRole($role);

        $response = $this->injectId($user->id)->makeCall();

        $response->assertOk();
        $responseContent = $this->getResponseContentObject();
        $this->assertSame($role->name, $responseContent->data[0]->name);
    }
}
