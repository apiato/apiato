<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Port\Test\PHPUnit\Abstracts\TestCase;

/**
 * Class FindRoleByNameTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindRoleByNameTest extends TestCase
{

    protected $endpoint = '/role/{name}';

    protected $access = [
        'roles'       => 'admin',
        'permissions' => '',
    ];

    public function testGetRole_()
    {
        $this->getTestingAdmin();

        $roleName = 'admin';

        // send the HTTP request
        $response = $this->apiCall($this->injectEndpointId($this->endpoint, $roleName, true, '{name}'), 'get');

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($roleName, $responseObject->data->name);
    }

}
