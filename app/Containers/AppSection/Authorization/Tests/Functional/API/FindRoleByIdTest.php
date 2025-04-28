<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class FindRoleByIdTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/roles/{role_id}';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles'       => null,
    ];

    public function testFindRoleById(): void
    {
        $model = RoleFactory::new()->createOne();

        $testResponse = $this->injectId($model->id, replace: '{role_id}')->makeCall();

        $testResponse->assertOk();

        $responseContent = $this->getResponseContentObject();
        $this->assertSame($model->name, $responseContent->data->name);
    }

    public function testFindNonExistingRole(): void
    {
        $invalidId = 7777777;

        $testResponse = $this->injectId($invalidId, replace: '{role_id}')->makeCall();

        $testResponse->assertNotFound();
    }
}
