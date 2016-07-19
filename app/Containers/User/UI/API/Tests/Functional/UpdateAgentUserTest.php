<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Models\User;
use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class UpdateAgentUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateAgentUserTest extends TestCase
{

    private $endpoint = '/register/agent';

    public function testRegisterExistingAgentUser_()
    {
        $data = [
            'email'    => 'new@user.com',
            'password' => 'first#Password',
            'name'     => 'First time name',
        ];

        $agentId = str_random(40);

        $AgentUser = User::create([
            'agent_id' => $agentId,
            'device'   => 'Android',
            'platform' => 'Google Super OS',
        ]);

        $headers['Agent-Id'] = $agentId;

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false, $headers);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        $this->assertResponseContainKeyValue([
            'email' => $data['email'],
            'name'  => $data['name'],
        ], $response);

        // assert response contain the token
        $this->assertResponseContainKeys(['id', 'token'], $response);

        // assert the data is stored in the database
        $this->seeInDatabase('users', ['email' => $data['email']]);
        $this->seeInDatabase('users', ['agent_id' => $agentId]);
        $this->seeInDatabase('users', ['device' => $AgentUser->device]);
        $this->seeInDatabase('users', ['platform' => $AgentUser->platform]);
    }


}
