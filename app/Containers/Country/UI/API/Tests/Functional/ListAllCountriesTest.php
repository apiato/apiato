<?php

namespace App\Containers\Country\UI\API\Tests\Functional;

use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class ListAllCountriesTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllCountriesTest extends TestCase
{

    private $endpoint = '/countries';

    public function testListAllCountries_()
    {

        $this->getLoggedInTestingUser();

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
