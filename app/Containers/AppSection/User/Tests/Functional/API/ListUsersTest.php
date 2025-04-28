<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Functional\API;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversNothing]
final class ListUsersTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/users';

    protected array $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testCanIndexUsersAsAdmin(): void
    {
        $this->testingUser = UserFactory::new()->admin()->createOne();
        UserFactory::new()->count(2)->create();

        $testResponse = $this->makeCall();

        $testResponse->assertOk();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data', 4)
                ->etc(),
        );
    }
}
