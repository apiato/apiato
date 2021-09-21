<?php

namespace App\Containers\AppSection\User\UI\API\Tests\Functional;

use App\Containers\AppSection\User\UI\API\Tests\ApiTestCase;

/**
 * Class FindUsersTest.
 *
 * @group user
 * @group api
 */
class FindUserTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/users/{id}';

    protected array $access = [
        'roles' => '',
        'permissions' => 'search-users',
    ];

    public function testFindUser(): void
    {
        $user = $this->getTestingUser();

        $response = $this->injectId($user->id)->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        $this->assertEquals($user->name, $responseContent->data->name);
    }

    public function testFindFilteredUserResponse(): void
    {
        $user = $this->getTestingUser();

        $response = $this->injectId($user->id)->endpoint($this->endpoint . '?filter=email;name')->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($user->name, $responseContent->data->name);
        $this->assertEquals($user->email, $responseContent->data->email);
        $this->assertNotContains('id', json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR));
    }

    public function testFindUserWithRelation(): void
    {
        $user = $this->getTestingUser();

        $response = $this->injectId($user->id)->endpoint($this->endpoint . '?include=roles')->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        $this->assertEquals($user->email, $responseContent->data->email);
        $this->assertNotNull($responseContent->data->roles);
    }
}
