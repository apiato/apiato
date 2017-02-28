<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Models\User;
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

    public function testRefreshAnotherUserById_()
    {
        $user = $this->getTestingUser();

        $anotherUser = factory(User::class)->create();
        // send the HTTP request
        $response = $this->injectId($anotherUser->id)->makeCall();

        // assert response status is correct
        $this->assertEquals('500', $response->getStatusCode());
    }

}
