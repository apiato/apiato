<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class ListUserRolesTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/users/{user_id}/roles';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles'       => null,
    ];

    public function testGetUserRoles(): void
    {
        $model = UserFactory::new()->createOne();
        $role = RoleFactory::new()->createOne();
        $model->assignRole($role);

        $testResponse = $this->injectId($model->id, replace: '{user_id}')->makeCall();

        $testResponse->assertOk();

        $responseContent = $this->getResponseContentObject();
        $this->assertSame($role->name, $responseContent->data[0]->name);
    }
}
