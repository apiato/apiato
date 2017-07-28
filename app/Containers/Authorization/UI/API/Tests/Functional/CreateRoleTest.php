<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Tests\TestCase;

/**
 * Class CreateRoleTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateRoleTest extends TestCase
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
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['name'], $responseContent->data->name);
    }

    public function testCreateRoleWithWrongName_()
    {
        $data = [
            'name'         => 'include space',
            'display_name' => 'manager',
            'description'  => 'he manages things',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);
    }

}
