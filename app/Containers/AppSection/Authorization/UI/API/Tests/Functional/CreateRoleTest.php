<?php

namespace App\Containers\AppSection\Authorization\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\UI\API\Tests\ApiTestCase;

/**
 * Class CreateRoleTest.
 *
 * @group authorization
 * @group api
 */
class CreateRoleTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/roles';

    protected array $access = [
        'roles' => '',
        'permissions' => 'manage-roles',
    ];

    public function testCreateRole(): void
    {
        $data = [
            'name' => 'manager',
            'display_name' => 'manager',
            'description' => 'he manages things',
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(201);
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

        $response->assertStatus(422);
    }
}
