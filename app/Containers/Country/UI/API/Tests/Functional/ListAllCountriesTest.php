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

    protected $endpoint = 'get@countries';

    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    public function testListAllCountries_()
    {
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        // convert JSON response string to object
        $responseObject = $this->getResponseObject($response);

        // assert the returned data size is correct
        $this->assertCount(249, $responseObject->data);
    }

}
