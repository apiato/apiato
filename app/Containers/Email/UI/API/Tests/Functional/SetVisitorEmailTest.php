<?php

namespace App\Containers\Email\UI\API\Tests\Functional;

use App\Containers\Email\Mails\ConfirmEmail;
use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class SetUserEmailTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SetVisitorEmailTest extends TestCase
{

    private $endpoint = '/visitors/email';

    public function testSetVisitorEmail_()
    {
        $data = [
            'email' => 'test@test.test',
        ];

        $visitor = $this->getVisitor();

        $headers['visitor-id'] = $visitor->visitor_id;

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false, $headers);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '202');

        $this->assertResponseContainKeyValue(['message' => 'Visitor Email Saved Successfully.'], $response);

        $this->seeInDatabase('users', ['email' => $data['email']]);
    }

}
