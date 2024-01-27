<?php

namespace App\Containers\AppSection\User\Tests\Functional\API;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Enums\Gender;
use App\Containers\AppSection\User\Tests\Functional\ApiTestCase;
use Illuminate\Support\Carbon;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversNothing]
final class UpdateUserTest extends ApiTestCase
{
    protected string $endpoint = 'patch@v1/users/{id}';

    protected array $access = [
        'permissions' => null,
        'roles' => null,
    ];

    public function testCanUpdateAsOwner(): void
    {
        $this->testingUser = UserFactory::new()->createOne([
            'name' => 'He who must not be named',
            'gender' => Gender::FEMALE,
        ]);
        $data = [
            'name' => 'Updated Name',
            'gender' => Gender::MALE->value,
            'birth' => Carbon::today(),
        ];

        $response = $this->injectId($this->testingUser->id)->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json): AssertableJson => $json->has(
                'data',
                fn (AssertableJson $json): AssertableJson => $json
                    ->where('object', 'User')
                    ->where('email', $this->testingUser->email)
                    ->where('name', $data['name'])
                    ->where('gender', $data['gender'])
                    ->where('birth', static fn ($birth) => $data['birth']->isSameDay($birth))
                    ->missing('password')
                    ->etc(),
            )->etc(),
        );
    }
}
