<?php

namespace App\Containers\AppSection\User\Tests\Functional\API;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\Functional\ApiTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class DeleteUserTest extends ApiTestCase
{
    protected string $endpoint = 'delete@v1/users/{user_id}';
    protected string $myUrl = 'v1/users/{user_id}';

    public function testCannotDeleteSelf(): void
    {
        $user = User::factory()->admin()->createOne();
        $this->actingAs($user);

        $response = $this->injectId($user->id, replace: '{user_id}')->makeCall();

        $response->assertUnprocessable();
    }

    public function testCanDeleteAnotherUserAsAdmin(): void
    {
        $user = User::factory()->admin()->createOne();
        $this->actingAs($user);

        $response = $this->injectId(User::factory()->createOne()->id, replace: '{user_id}')->makeCall();

        $response->assertNoContent();
    }

    public function testGivenUserHasNoAccessPreventsOperation(): void
    {
        $this->actingAs(User::factory()->createOne());

        $response = $this->makeCall();

        $response->assertForbidden();
    }
}
