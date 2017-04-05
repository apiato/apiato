<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Tests\TestCase;

/**
 * Class FindPermissionTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindPermissionTest extends TestCase
{

    protected $endpoint = 'get@v1/permissions/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-roles',
    ];

    public function testFindPermissionById_()
    {
        $permissionA = factory(Permission::class)->create();

        // send the HTTP request
        $response = $this->injectId($permissionA->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($permissionA->name, $responseContent->data->name);
    }

}
