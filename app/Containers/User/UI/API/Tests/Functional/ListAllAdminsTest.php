<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Role;
use App\Containers\User\Models\User;
use App\Port\Test\PHPUnit\Abstracts\TestCase;

/**
 * Class ListAllUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllAdminsTest extends TestCase
{

    protected $endpoint = '/admins';

    protected $access = [
        'roles'       => 'admin',
        'permissions' => 'list-users',
    ];

    public function testListAllAdmins_()
    {
        $this->getTestingAdmin();

        // create some non-admin users
        $user1 = factory(User::class)->create();
        $adminRole = Role::where('name', 'admin')->first();
        $user1->assignRole($adminRole);

        $user2 = factory(User::class)->create();
        $adminRole = Role::where('name', 'admin')->first();
        $user2->assignRole($adminRole);

        // should not be returned
        $user3 = factory(User::class)->create();

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get');

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        // convert JSON response string to Object
        $responseObject = $this->getResponseObject($response);

        // assert the returned data size is correct
        $this->assertCount(4,
            $responseObject->data); // 4 = 4 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }

}
