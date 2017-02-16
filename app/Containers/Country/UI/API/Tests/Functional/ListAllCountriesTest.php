<?php

namespace App\Containers\Country\UI\API\Tests\Functional;

use App\Containers\Country\Tests\TestCase;

/**
 * Class ListAllCountriesTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllCountriesTest extends TestCase
{

    protected $endpoint = '/countries';

    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    public function testListAllCountries_()
    {
        $this->getTestingUser();

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get');

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        // convert JSON response string to object
        $responseObject = $this->getResponseObject($response);

        // assert the returned data size is correct
        $this->assertCount(249, $responseObject->data);
    }

}
