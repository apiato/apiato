<?php

namespace App\Containers\AppSection\User\UI\API\Tests\Functional;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\UI\API\Tests\ApiTestCase;

/**
 * @group user
 * @group api
 */
class DeleteUserTest extends ApiTestCase
{
    protected string $endpoint = 'delete@v1/users/{id}';

    protected array $access = [
        'permissions' => 'delete-users',
        'roles' => '',
    ];

    public function testDeleteExistingUser(): void
    {
        $user = $this->getTestingUser();

        $response = $this->injectId($user->id)->makeCall();

        $response->assertNoContent();
    }

    public function testDeleteNonExistingUser(): void
    {
        $invalidId = 7777;

        $response = $this->injectId($invalidId)->makeCall([]);

        $response->assertNotFound();
    }

    public function testGivenHaveNoAccessCannotDeleteAnotherUser(): void
    {
        $this->getTestingUserWithoutAccess();
        $anotherUser = User::factory()->create();

        $response = $this->injectId($anotherUser->id)->makeCall();

        $response->assertForbidden();
    }
}
