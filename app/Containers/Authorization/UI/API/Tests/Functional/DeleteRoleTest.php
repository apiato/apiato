<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\TestCase;

/**
 * Class DeleteRoleTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteRoleTest extends TestCase
{

    protected $endpoint = '/roles/{name}';

    protected $access = [
        'roles'       => 'admin',
        'permissions' => '',
    ];

    public function testDeleteExistingRole_()
    {
        $this->getTestingAdmin();

        $role = factory(Role::class)->create();

        // send the HTTP request
        $response = $this->apiCall($this->injectEndpointId($this->endpoint, $role->name, true, '{name}'), 'delete');

        // assert response status is correct
        $this->assertEquals('202', $response->getStatusCode());

        // assert the returned message is correct
        $this->assertResponseContainKeyValue([
            'message' => 'Role (' . $role->name . ') Deleted Successfully.',
        ], $response);
    }

}
