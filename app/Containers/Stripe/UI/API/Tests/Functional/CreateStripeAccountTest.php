<?php

namespace App\Containers\Stripe\UI\API\Tests\Functional;

use App\Containers\Stripe\Tests\ApiTestCase;

/**
 * Class CreateStripeAccountTest.
 *
 * @group stripe
 * @group api
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateStripeAccountTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/user/payments/accounts/stripe';

    protected array $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    public function testCreateStripeAccount(): void
    {
        $userDetails = [
            'name'     => 'Mahmoud Zalt',
            'email'    => 'mahmoud@testttt.test',
            'password' => 'passssssssssss',
        ];
        $this->getTestingUser($userDetails);
        $data = [
            'customer_id'      => 'cus_123456789',
            'card_id'          => 'car_123456789',
            'card_funding'     => 'qwerty',
            'card_last_digits' => '1234',
            'card_fingerprint' => 'zxcvbn',
            'nickname'         => 'test account for stripe',
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(202);
        $responseContent = $this->getResponseContentObject();
        self::assertEquals('Stripe account created successfully.', $responseContent->message);
    }
}
