<?php

namespace App\Containers\AppSection\User\Tests\Functional\API;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\Functional\ApiTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
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
        $anotherUser = UserFactory::new()->createOne();

        $response = $this->injectId($anotherUser->id)->makeCall();

        $response->assertForbidden();
    }
}
