<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class DeleteRoleTest extends ApiTestCase
{
    protected string $endpoint = 'delete@v1/roles/{role_id}';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles'       => null,
    ];

    public function testCanDeleteRole(): void
    {
        $model = RoleFactory::new()->createOne();

        $testResponse = $this->injectId($model->id, replace: '{role_id}')->makeCall();

        $testResponse->assertNoContent();
    }
}
