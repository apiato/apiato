<?php

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
        'permissions' => 'list-users',
        'roles' => null,
    ];

    public function testListUsersByAdmin(): void
    {
        UserFactory::new()->count(2)->create();
        $this->getTestingUserWithoutAccess(createUserAsAdmin: true);

        $response = $this->makeCall();

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data', 4)
                    ->etc(),
        );
    }

    public function testListUsersByNonAdmin(): void
    {
        $this->getTestingUserWithoutAccess();
        UserFactory::new()->count(2)->create();

        $response = $this->makeCall();

        $response->assertForbidden();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('message')
                    ->where('message', 'You are not authorized to request this resource.')
                    ->etc(),
        );
    }

    public function testSearchUsersByName(): void
    {
        UserFactory::new()->count(3)->create();
        $user = $this->getTestingUser([
            'name' => 'mahmoudzzz',
        ]);

        $response = $this->endpoint($this->endpoint . '?search=name:' . urlencode($user->name))->makeCall();

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                    ->where('data.0.name', $user->name)
                    ->etc(),
        );
    }

    public function testSearchUsersByHashID(): void
    {
        UserFactory::new()->count(3)->create();
        $user = $this->getTestingUser();

        $response = $this->endpoint($this->endpoint . '?search=id:' . $user->getHashedKey())->makeCall();

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                    ->where('data.0.id', $user->getHashedKey())
                    ->etc(),
        );
    }
}
