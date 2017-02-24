<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Tests\TestCase;

/**
 * Class RefreshUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RefreshUserTest extends TestCase
{

    protected $endpoint = 'post@users/{id}/refresh';

    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    public function testRefreshUserById_()
    {
        $user = $this->getTestingUser();

        // send the HTTP request
        $response = $this->injectId($user->id)->makeCall();

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());
    }

}
