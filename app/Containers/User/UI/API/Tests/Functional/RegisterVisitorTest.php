<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class RegisterVisitorTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterVisitorTest extends TestCase
{

    private $endpoint = '/visitor/register';

    public function testRegisterNewVisitor_()
    {
        $this->getLoggedInTestingUser();

        $headers['visitor-id'] = str_random('20');

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', [], false, $headers);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        // assert returned user is the updated one
        $this->assertResponseContainKeys('id', $response);

        // assert data was updated in the database
        $this->seeInDatabase('users', ['visitor_id' => $headers['visitor-id']]);
    }

    public function testRegisterExistingVisitor_()
    {
        $user = $this->getLoggedInTestingUser();
        $user->visitor_id = str_random('20');
        $user->name = 'Tester';
        unset($user->token);
        $user->save();

        $headers['visitor-id'] = $user->visitor_id;

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', [], false, $headers);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        // assert returned user is the updated one
        $this->assertResponseContainKeyValue([
            'name' => $user->name,
        ], $response);

        // assert data was updated in the database
        $this->seeInDatabase('users', ['name' => $user->name]);
    }


}
