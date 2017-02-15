<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Port\Test\PHPUnit\Abstracts\TestCase;

/**
 * Class CreateRoleTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateRoleTest extends TestCase
{

    protected $endpoint = '/roles';

    protected $access = [
        'roles'       => 'admin',
        'permissions' => '',
    ];

    public function testCreateRole_()
    {
        $this->getTestingAdmin();

        $data = [
            'name'         => 'Manager',
            'display_name' => 'manager',
            'description'  => 'he manages things',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($data['name'], $responseObject->data->name);
    }

    public function testCreateRoleWithWrongName_()
    {
        $this->getTestingAdmin();

        $data = [
            'name'         => 'include space',
            'display_name' => 'manager',
            'description'  => 'he manages things',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals('422', $response->getStatusCode());
    }

}
