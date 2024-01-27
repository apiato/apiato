<?php

namespace App\Containers\AppSection\User\Tests\Functional\API;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\Functional\ApiTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversNothing]
final class DeleteUserTest extends ApiTestCase
{
    protected string $endpoint = 'delete@v1/users/{id}';

    protected array $access = [
        'permissions' => null,
        'roles' => null,
    ];

    public function testCanDeleteSelfAsAdmin(): void
    {
        $this->testingUser = UserFactory::new()->admin()->createOne();

        $response = $this->injectId($this->testingUser->id)->makeCall();

        $response->assertNoContent();
    }

    public function testCanDeleteAnotherUserAsAdmin(): void
    {
        $this->testingUser = UserFactory::new()->admin()->createOne();

        $response = $this->injectId(UserFactory::new()->createOne()->id)->makeCall();

        $response->assertNoContent();
    }
}
