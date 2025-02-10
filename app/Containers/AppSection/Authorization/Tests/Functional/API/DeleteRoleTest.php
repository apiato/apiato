<?php

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class DeleteRoleTest extends ApiTestCase
{
    protected string $endpoint = 'delete@v1/roles/{role_id}';

    public function testCanDeleteRole(): void
    {
        $this->actingAs(User::factory()->admin()->createOne());
        $role = Role::factory()->createOne();

        $response = $this->injectId($role->id, replace: '{role_id}')->makeCall();

        $response->assertNoContent();
    }

    public function testGivenUserHasNoAccessPreventsOperation(): void
    {
        $this->actingAs(User::factory()->createOne());

        $response = $this->makeCall();

        $response->assertForbidden();
    }
}
