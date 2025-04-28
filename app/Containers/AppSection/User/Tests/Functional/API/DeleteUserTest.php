<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Functional\API;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\Functional\ApiTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class DeleteUserTest extends ApiTestCase
{
    protected string $endpoint = 'delete@v1/users/{user_id}';

    protected array $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testCanDeleteSelfAsAdmin(): void
    {
        $this->testingUser = UserFactory::new()->admin()->createOne();

        $testResponse = $this->injectId($this->testingUser->id, replace: '{user_id}')->makeCall();

        $testResponse->assertNoContent();
    }

    public function testCanDeleteAnotherUserAsAdmin(): void
    {
        $this->testingUser = UserFactory::new()->admin()->createOne();

        $testResponse = $this->injectId(UserFactory::new()->createOne()->id, replace: '{user_id}')->makeCall();

        $testResponse->assertNoContent();
    }
}
