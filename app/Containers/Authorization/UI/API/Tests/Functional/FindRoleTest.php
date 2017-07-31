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

    protected $endpoint = 'get@v1/roles/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-roles',
    ];

    public function testFindRoleById_()
    {
        $roleA = factory(Role::class)->create();

        // send the HTTP request
        $response = $this->injectId($roleA->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($roleA->name, $responseContent->data->name);
    }

}
