<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Tests\ApiTestCase;

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
        $admin = $this->getTestingUser();

        $response = $this->injectId($admin->id)->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();

        self::assertEquals($admin->name, $responseContent->data->name);
    }

    public function testFindFilteredUserResponse(): void
    {
        $admin = $this->getTestingUser();

        $response = $this->injectId($admin->id)->endpoint($this->endpoint . '?filter=email;name')->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();

        self::assertEquals($admin->name, $responseContent->data->name);
        self::assertEquals($admin->email, $responseContent->data->email);
        self::assertNotContains('id', json_decode($response->getContent(), true));
    }

    public function testFindUserWithRelation(): void
    {
        $admin = $this->getTestingUser();

        $response = $this->injectId($admin->id)->endpoint($this->endpoint . '?include=roles')->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();

        self::assertEquals($admin->email, $responseContent->data->email);

        self::assertNotNull($responseContent->data->roles);
    }
}
