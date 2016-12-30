<?php

namespace App\Containers\Order\UI\API\Tests\Functional;

use App\Containers\User\Models\User;
use App\Port\Tests\PHPUnit\Abstracts\TestCase;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class AssignUserToRoleTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class AssignUserToRoleTest extends TestCase
{

    private $endpoint = '/roles/assign';

    public function testAssignUserToRole_()
    {
        $admin = $this->getLoggedInTestingAdmin();

        $randomUser = factory(User::class)->create();

        $data = [
            'name'    => 'admin',
            'user_id' => $randomUser->id,
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

//        $this->assertEquals($data['user_id'], Hashids::decode($responseObject->data->id));
    }


    public function testAssignUserToManyRoles_()
    {
        $admin = $this->getLoggedInTestingAdmin();

        $randomUser = factory(User::class)->create();

        $data = [
            'name'    => ['admin', 'client'],
            'user_id' => $randomUser->id,
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        $responseObject = $this->getResponseObject($response);

        $this->assertTrue(count($responseObject->data->roles->data) > 1);
    }

}
