<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Functional\API;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class FindUserByIdTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/users/{user_id}';

    protected array $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testCanFindSelfAsAdmin(): void
    {
        $this->testingUser = UserFactory::new()->admin()->createOne();

        $testResponse = $this->injectId($this->testingUser->id, replace: '{user_id}')->makeCall();

        $testResponse->assertOk();
        $testResponse->assertJson(
            fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->where('data.id', $this->encode($this->testingUser->id))
                ->etc(),
        );
    }

    public function testCanFindAnotherUserAsAdmin(): void
    {
        $this->testingUser = UserFactory::new()->admin()->createOne();

        $testResponse = $this->injectId(UserFactory::new()->createOne()->id, replace: '{user_id}')->makeCall();

        $testResponse->assertOk();
    }
}
