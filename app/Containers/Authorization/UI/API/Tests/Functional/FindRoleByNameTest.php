<?php

namespace App\Containers\Order\UI\API\Tests\Functional;

use App\Containers\Order\Models\Order;
use App\Containers\Invoice\Models\Invoice;
use App\Containers\User\Models\User;
use App\Port\Test\PHPUnit\Abstracts\TestCase;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class FindRoleByNameTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindRoleByNameTest extends TestCase
{

    private $endpoint = '/find-role';

    public function testGetRole_()
    {
        $admin = $this->getLoggedInTestingAdmin();

        $data = ['name' => 'admin'];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get', $data, true);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($data['name'], $responseObject->data->name);
    }

}
