<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversNothing]
class FindRoleTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/roles/{id}';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => '',
    ];

    public function testFindRoleById(): void
    {
        $roleA = RoleFactory::new()->createOne();

        $response = $this->injectId($roleA->id)->makeCall();

        $response->assertOk();
        $responseContent = $this->getResponseContentObject();
        $this->assertEquals($roleA->name, $responseContent->data->name);
    }

    public function testFindNonExistingRole(): void
    {
        $invalidId = 7777;

        $response = $this->injectId($invalidId)->makeCall([]);

        $response->assertNotFound();
    }
}
