<?php

namespace App\Containers\Paypal\UI\API\Tests\Functional;

use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class CreatePaypalAccountTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreatePaypalAccountTest extends TestCase
{

    private $endpoint = '/paypals';

    public function testCreatePaypalAccount()
    {
        $userDetails = [
            'name' => 'Mahmoud Zalt',
            'email' => 'mahmoud@testttt.test',
            'password' => 'passssssssssss',
        ];
        // get the logged in user (create one if no one is logged in)
        $user = $this->registerAndLoginTestingUser($userDetails);

        $data = [
           // TODO: To Be Continue...
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '202');

        // convert JSON response string to Object
        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($responseObject->message, 'Paypal account created successfully.');

    }

}
