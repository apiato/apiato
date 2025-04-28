<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class ListUserPermissionsTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/users/{user_id}/permissions';

    protected array $access = [
        'permissions' => 'manage-permissions',
        'roles'       => null,
    ];

    public function testGetUserPermissions(): void
    {
        $model = UserFactory::new()->createOne();
        $permission = PermissionFactory::new()->createOne();
        $model->givePermissionTo([$permission]);

        $testResponse = $this->injectId($model->id, replace: '{user_id}')->makeCall();

        $testResponse->assertOk();

        $responseContent = $this->getResponseContentObject();
        $this->assertSame($permission->name, $responseContent->data[0]->name);
    }
}
