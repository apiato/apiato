<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Port\Test\PHPUnit\Abstracts\TestCase;

/**
 * Class FindPermissionByNameTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindPermissionByNameTest extends TestCase
{

    protected $endpoint = '/permission/{name}';

    protected $access = [
        'roles'       => 'admin',
        'permissions' => '',
    ];

    public function testGetPermission_()
    {
        $this->getTestingAdmin();

        $permissionName = 'delete-users';

        // send the HTTP request
        $response = $this->apiCall($this->injectEndpointId($this->endpoint, $permissionName, true, '{name}'), 'get');

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($permissionName, $responseObject->data->name);
    }

}
