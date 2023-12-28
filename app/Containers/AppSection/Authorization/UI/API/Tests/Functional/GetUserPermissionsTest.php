<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;

/**
 * @group authorization
 * @group api
 */
class GetUserPermissionsTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/users/{id}/permissions';

    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    public function testGetUserPermissions(): void
    {
        $user = UserFactory::new()->createOne();
        $permission = PermissionFactory::new()->createOne();
        $user->givePermissionTo([$permission]);

        $response = $this->injectId($user->id)->makeCall();

        $response->assertOk();
        $responseContent = $this->getResponseContentObject();
        $this->assertEquals($permission->name, $responseContent->data[0]->name);
    }
}
