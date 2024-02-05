<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversNothing]
final class ListPermissionsTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/permissions';

    protected array $access = [
        'permissions' => 'manage-permissions',
        'roles' => null,
    ];

    public function testListPermissions(): void
    {
        $response = $this->makeCall();

        $response->assertOk();
        $responseContent = $this->getResponseContentObject();
        $this->assertNotEmpty($responseContent->data);
    }
}
