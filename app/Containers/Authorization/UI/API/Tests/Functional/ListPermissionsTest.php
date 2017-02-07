<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\User;
use App\Port\Test\PHPUnit\Abstracts\TestCase;

/**
 * Class ListPermissionsTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListPermissionsTest extends TestCase
{

    protected $endpoint = '/permissions';

    protected $permissions = [
        'admin-access' // no need to set `admin-access` since it's given to the admins by default while seeding.
    ];

    public function testListAllPermissions_()
    {
        $this->getLoggedInTestingAdmin();

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get');

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        // convert JSON response string to Object
        $responseObject = $this->getResponseObject($response);

        $this->assertTrue(count($responseObject->data) > 0);
    }

}
