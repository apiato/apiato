<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Tests\ApiTestCase;

/**
 * Class CreateRoleTest.
 *
 * @group authorization
 * @group api
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateRoleTest extends ApiTestCase
{

    protected $endpoint = 'post@v1/roles';

    protected $auth = true;

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-roles',
    ];

    public function testCreateRole_()
    {
        $data = [
            'name'         => 'manager',
            'display_name' => 'manager',
            'description'  => 'he manages things',
            'level'        => 7,
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['name'], $responseContent->data->name);
        $this->assertEquals($data['level'], $responseContent->data->level);
    }

    public function testCreateRoleWithoutLevel_()
    {
        $data = [
            'name'         => 'manager',
            'display_name' => 'manager',
            'description'  => 'he manages things',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals(0, $responseContent->data->level);
    }

    public function testCreateRoleWithWrongName_()
    {
        $data = [
            'name'         => 'include Space',
            'display_name' => 'manager',
            'description'  => 'he manages things',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);
    }

}
