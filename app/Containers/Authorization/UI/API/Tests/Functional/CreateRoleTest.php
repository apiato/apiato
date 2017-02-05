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

    private $endpoint = '/roles';

    public function testCreateRole_()
    {
        $admin = $this->getLoggedInTestingAdmin();

        $data = [
            'name'         => 'Manager',
            'display_name' => 'manager',
            'description'  => 'he manages things',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($data['name'], $responseObject->data->name);
    }

}
