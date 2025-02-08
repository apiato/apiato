<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Enums\Role;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class ListRolesTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/roles';

    protected array $access = [
        'permissions' => null,
        'roles' => Role::SUPER_ADMIN,
    ];

    public function testListRoles(): void
    {
        $this->getTestingUser();

        $response = $this->makeCall();

        $response->assertOk();
        $responseContent = $this->getResponseContentObject();
        $this->assertNotEmpty($responseContent->data);
    }
}
