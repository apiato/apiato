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

    private $endpoint = '/permissions';

    public function testCreatePermission_()
    {
        $admin = $this->getLoggedInTestingAdmin();

        $data = [
            'name'         => 'eat-people',
            'display_name' => 'zombie',
            'description'  => 'can eat people',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($data['name'], $responseObject->data->name);
    }

}
