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

    protected $endpoint = '/find-role';

    protected $access = [
        'roles'       => 'admin',
        'permissions' => '',
    ];

    public function testGetRole_()
    {
        $this->getTestingAdmin();

        $data = ['name' => 'admin'];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get', $data, true);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($data['name'], $responseObject->data->name);
    }

}
