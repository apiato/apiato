<?php

namespace App\Containers\Stripe\UI\API\Tests\Functional;

use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class CreateStripeAccountTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateStripeAccountTest extends TestCase
{

    private $endpoint = '/stripes';

    public function testCreateStripeAccount()
    {
        $userDetails = [
            'name' => 'Mahmoud Zalt',
            'email' => 'mahmoud@testttt.test',
            'password' => 'passssssssssss',
        ];
        // get the logged in user (create one if no one is logged in)
        $user = $this->registerAndLoginTestingUser($userDetails);

        $data = [
            'customer_id'      => 'cus_123456789',
            'card_id'          => 'car_123456789',
            'card_funding'     => 'qwerty',
            'card_last_digits' => '1234',
            'card_fingerprint' => 'zxcvbn',
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '202');

        // convert JSON response string to Object
        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($responseObject->message, 'Stripe account created successfully.');

    }

}
