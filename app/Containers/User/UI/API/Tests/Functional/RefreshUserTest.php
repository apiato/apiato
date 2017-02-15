<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Port\Test\PHPUnit\Abstracts\TestCase;

/**
 * Class RefreshUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RefreshUserTest extends TestCase
{

    protected $endpoint = '/users/{id}/refresh';

    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    public function testRefreshUserById_()
    {
        // get the logged in user (create one if no one is logged in)
        $user = $this->createTestingUser();

        // send the HTTP request
        $response = $this->apiCall($this->injectEndpointId($this->endpoint, $user->id), 'post');

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());
    }

}
