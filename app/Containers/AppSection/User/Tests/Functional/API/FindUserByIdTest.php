<?php

namespace App\Containers\AppSection\User\Tests\Functional\API;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversNothing]
final class FindUserByIdTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/users/{id}';

    protected array $access = [
        'permissions' => null,
        'roles' => null,
    ];

    public function testCanFindSelfAsAdmin(): void
    {
        $this->testingUser = UserFactory::new()->admin()->createOne();

        $response = $this->injectId($this->testingUser->id)->makeCall();

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->where('data.id', $this->encode($this->testingUser->id))
                ->etc(),
        );
    }

    public function testCanFindAnotherUserAsAdmin(): void
    {
        $this->testingUser = UserFactory::new()->admin()->createOne();

        $response = $this->injectId(UserFactory::new()->createOne()->id)->makeCall();

        $response->assertOk();
    }
}
