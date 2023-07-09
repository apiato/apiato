<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;

/**
 * @group authorization
 * @group api
 */
class CreateRoleTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/roles';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => '',
    ];

    public function testCreateRole(): void
    {
        $data = [
            'name' => 'manager',
            'display_name' => 'manager',
            'description' => 'he manages things',
        ];

        $response = $this->makeCall($data);

        $response->assertCreated();
        $responseContent = $this->getResponseContentObject();
        $this->assertEquals($data['name'], $responseContent->data->name);
    }

    public function testCreateRoleWithWrongName(): void
    {
        $data = [
            'name' => 'includes Space',
            'display_name' => 'manager',
            'description' => 'he manages things',
        ];

        $response = $this->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('message')
                    ->has('errors')
                    ->where('errors.name.0', 'String should not contain space.')
        );
    }

    public function testGivenHaveNoAccessCannotCreateRole(): void
    {
        $this->getTestingUserWithoutAccess();

        $response = $this->makeCall([]);

        $response->assertForbidden();
    }
}
