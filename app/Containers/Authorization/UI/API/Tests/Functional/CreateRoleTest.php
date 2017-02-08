<?php

namespace App\Containers\Order\UI\API\Tests\Functional;

use App\Port\Test\PHPUnit\Abstracts\TestCase;

/**
 * Class CreateRoleTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateRoleTest extends TestCase
{

    protected $endpoint = '/roles';

    protected $permissions = [
        'admin-access' // no need to set `admin-access` since it's given to the admins by default while seeding.
    ];

    public function testCreateRole_()
    {
        $this->getLoggedInTestingAdmin();

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

}
