<?php

namespace App\Containers\Wepay\UI\API\Tests\Functional;

use App\Containers\Wepay\Tests\TestCase;

/**
 * Class CreateWepayAccountTest.
 *
 * @author Rockers Technologies <jaimin.rockersinfo@gmail.com>
 */
class CreateWepayAccountTest extends TestCase
{

    protected $endpoint = 'post@v1/user/payments/accounts/wepay';

    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    public function testCreateWepayAccount_()
    {
        $userDetails = [
            'name'     => $this->faker->name,
            'email'    => $this->faker->email,
            'password' => '123456789',
        ];
        
        // get the logged in user (create one if no one is logged in)
        $user = $this->getTestingUser($userDetails);

        $data = [
            'name'          => $this->faker->name,
            'description'   => $this->faker->text(50),
            'type'          => 'personal',
            'imageUrl'      => 'https://someurl.com',
            'country'       => 'US',
            'currencies'    => 'USD',
            'nickname'      => 'test account for wepay',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(202);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($responseContent->message, 'Wepay account created successfully.');

    }

}
