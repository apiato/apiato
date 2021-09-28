<?php

namespace App\Containers\AppSection\User\UI\API\Tests\Functional;

use App\Containers\AppSection\User\UI\API\Tests\ApiTestCase;
use Illuminate\Support\Carbon;
use Illuminate\Testing\Fluent\AssertableJson;

/**
 * Class UpdateUserTest.
 *
 * @group user
 * @group api
 */
class UpdateUserTest extends ApiTestCase
{
    protected string $endpoint = 'patch@v1/users/{id}';

    protected array $access = [
        'roles' => '',
        'permissions' => 'update-users',
    ];

    public function testUpdateExistingUser(): void
    {
        $user = $this->getTestingUser();
        $data = [
            'name' => 'Updated Name',
            'password' => 'updated#Password',
            'gender' => 'male',
            'birth' => '2015-10-15',
        ];

        $response = $this->injectId($user->id)->makeCall($data);

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) =>
                $json->has('data')
                    ->where('data.object', 'User')
                    ->where('data.email', $user->email)
                    ->where('data.name', $data['name'])
                    ->where('data.gender', $data['gender'])
                    ->where('data.birth', Carbon::parse($data['birth'])->toISOString())
                    ->etc()
        );

        $this->assertDatabaseHas('users', ['name' => $data['name']]);
    }

    public function testUpdateNonExistingUser(): void
    {
        $fakeUserId = 7777;

        $response = $this->injectId($fakeUserId)->makeCall([]);

        $response->assertStatus(422);
        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has('errors')
                ->where('errors.id.0', 'The selected id is invalid.')
                ->etc()
        );
    }

    public function testUpdateExistingUserWithEmptyValues(): void
    {
        $user = $this->getTestingUser();
        $data = [
            'name' => '',
            'password' => '',
            'gender' => '',
            'birth' => '',
        ];

        $response = $this->injectId($user->id)->makeCall($data);

        $response->assertStatus(422);
        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has('errors')
                ->where('errors.password.0', 'The password must be at least 6 characters.')
                ->where('errors.name.0', 'The name must be at least 2 characters.')
                ->where('errors.gender.0', 'The selected gender is invalid.')
                ->where('errors.birth.0', 'The birth is not a valid date.')
                ->etc()
        );
    }
}
