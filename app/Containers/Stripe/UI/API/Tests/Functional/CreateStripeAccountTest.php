<?php

namespace App\Containers\Stripe\UI\API\Tests\Functional;

use App\Containers\Stripe\Tests\TestCase;

/**
 * Class CreateStripeAccountTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateStripeAccountTest extends TestCase
{

    protected $endpoint = 'post@v1/stripes';

    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    public function testCreateStripeAccount_()
    {
        $userDetails = [
            'name'     => 'Mahmoud Zalt',
            'email'    => 'mahmoud@testttt.test',
            'password' => 'passssssssssss',
        ];
        // get the logged in user (create one if no one is logged in)
        $this->getTestingUser($userDetails);

        $data = [
            'customer_id'      => 'cus_123456789',
            'card_id'          => 'car_123456789',
            'card_funding'     => 'qwerty',
            'card_last_digits' => '1234',
            'card_fingerprint' => 'zxcvbn',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(202);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($responseContent->message, 'Stripe account created successfully.');

    }

}
