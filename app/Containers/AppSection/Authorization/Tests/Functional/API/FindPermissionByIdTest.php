<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversNothing]
final class FindPermissionByIdTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/permissions/{id}';

    protected array $access = [
        'permissions' => 'manage-permissions',
        'roles' => null,
    ];

    public function testFindPermissionById(): void
    {
        $permissionA = PermissionFactory::new()->createOne();

        $response = $this->injectId($permissionA->id)->makeCall();

        $response->assertOk();
        $responseContent = $this->getResponseContentObject();
        $this->assertSame($permissionA->name, $responseContent->data->name);
    }

    public function testFindNonExistingPermission(): void
    {
        $invalidId = 7777777;

        $response = $this->injectId($invalidId)->makeCall();

        $response->assertNotFound();
    }
}
