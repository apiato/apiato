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

    protected $endpoint = 'post@roles';

    protected $auth = true;

    protected $access = [
        'roles'       => 'admin',
        'permissions' => '',
    ];

    public function testCreateRole_()
    {
        $data = [
            'name'         => 'Manager',
            'display_name' => 'manager',
            'description'  => 'he manages things',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($data['name'], $responseObject->data->name);
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
        $this->assertEquals('422', $response->getStatusCode());
    }

}
