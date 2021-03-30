<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Models\User;
use App\Containers\User\Tests\ApiTestCase;

/**
 * Class DeleteUserTest.
 *
 * @group user
 * @group api
 */
class DeleteUserTest extends ApiTestCase
{
    protected string $endpoint = 'delete@v1/users/{id}';

    protected array $access = [
        'roles' => '',
        'permissions' => 'delete-users',
    ];

    public function testDeleteExistingUser(): void
    {
        $user = $this->getTestingUser();

        $response = $this->injectId($user->id)->makeCall();

        $response->assertStatus(204);
    }

    public function testDeleteAnotherExistingUser(): void
    {
        $this->getTestingUserWithoutAccess();
        $anotherUser = User::factory()->create();

        $response = $this->injectId($anotherUser->id)->makeCall();

        $response->assertStatus(403);
    }
}
