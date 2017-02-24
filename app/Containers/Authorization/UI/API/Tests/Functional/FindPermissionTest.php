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

    protected $endpoint = 'get@permissions/{id}';

    protected $access = [
        'roles'       => 'admin',
        'permissions' => '',
    ];

    public function testFindPermissionById_()
    {
        $permissionA = factory(Permission::class)->create();

        // send the HTTP request
        $response = $this->injectId($permissionA->id)->makeCall();

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($permissionA->name, $responseObject->data->name);
    }

}
