<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Tests\ApiTestCase;

/**
 * Class FindPermissionTest.
 *
 * @group authorization
 * @group api
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindPermissionTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/permissions/{id}';

    protected array $access = [
        'roles' => '',
        'permissions' => 'manage-roles',
    ];

    public function testFindPermissionById(): void
    {
        $permissionA = Permission::factory()->create();

        // send the HTTP request
        $response = $this->injectId($permissionA->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        self::assertEquals($permissionA->name, $responseContent->data->name);
    }
}
