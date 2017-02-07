<?php

namespace App\Containers\Order\UI\API\Tests\Functional;

use App\Containers\User\Models\User;
use App\Port\Test\PHPUnit\Abstracts\TestCase;

/**
 * Class AssignUserToRoleTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class AssignUserToRoleTest extends TestCase
{

    private $endpoint = '/roles/assign';

    public $permissions = [
        'admin-access' // no need to set `admin-access` since it's given to the admins by default while seeding.
    ];

    public function testAssignUserToRole_()
    {
        $this->getLoggedInTestingAdmin();

        $randomUser = factory(User::class)->create();

        $data = [
            'roles_names' => 'admin',
            'user_id'     => $randomUser->getHashedKey(),
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($randomUser->id, $responseObject->data->id);

        $this->assertEquals($data['roles_names'], $responseObject->data->roles->data[0]->name);
    }


    public function testAssignUserToManyRoles_()
    {
        $admin = $this->getLoggedInTestingAdmin();

        $randomUser = factory(User::class)->create();

        $data = [
            'roles_names' => ['admin', 'client'],
            'user_id'     => $randomUser->getHashedKey(),
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        $responseObject = $this->getResponseObject($response);

        $this->assertTrue(count($responseObject->data->roles->data) > 1);

        $this->assertEquals($data['roles_names'][0], $responseObject->data->roles->data[0]->name);

        $this->assertEquals($data['roles_names'][1], $responseObject->data->roles->data[1]->name);
    }

}
