<?php

namespace App\Containers\Order\UI\API\Tests\Functional;

use App\Port\Test\PHPUnit\Abstracts\TestCase;

/**
 * Class FindPermissionByNameTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindPermissionByNameTest extends TestCase
{

    protected $endpoint = '/find-permission';

    protected $permissions = [
        'admin-access' // no need to set `admin-access` since it's given to the admins by default while seeding.
    ];

    public function testGetPermission_()
    {
        $this->getLoggedInTestingAdmin();

        $data = ['name' => 'manage-roles-permissions'];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get', $data, true);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($data['name'], $responseObject->data->name);
    }

}
