<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\TestCase;

/**
 * Class FindRoleTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindRoleTest extends TestCase
{

    protected $endpoint = '/role/{id}';

    protected $access = [
        'roles'       => 'admin',
        'permissions' => '',
    ];

    public function testFindRoleById_()
    {
        $this->getTestingAdmin();

        $roleA = factory(Role::class)->create();

        // send the HTTP request
        $response = $this->apiCall($this->injectEndpointId($this->endpoint, $roleA->id), 'get');

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($roleA->name, $responseObject->data->name);
    }

}
