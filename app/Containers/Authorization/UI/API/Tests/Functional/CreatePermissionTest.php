<?php

namespace App\Containers\Order\UI\API\Tests\Functional;

use App\Port\Test\PHPUnit\Abstracts\TestCase;

/**
 * Class CreatePermissionTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreatePermissionTest extends TestCase
{

    protected $endpoint = '/permissions';

    protected $permissions = [
        'admin-access' // no need to set `admin-access` since it's given to the admins by default while seeding.
    ];

    public function testCreatePermission_()
    {
        $this->getLoggedInTestingAdmin();

        $data = [
            'name'         => 'eat-people',
            'display_name' => 'zombie',
            'description'  => 'can eat people',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($data['name'], $responseObject->data->name);
    }

}
