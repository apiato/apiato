<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversNothing]
final class DeleteRoleTest extends ApiTestCase
{
    protected string $endpoint = 'delete@v1/roles/{id}';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => null,
    ];

    public function testCanDeleteRole(): void
    {
        $role = RoleFactory::new()->createOne();

        $response = $this->injectId($role->id)->makeCall();

        $response->assertNoContent();
    }
}
