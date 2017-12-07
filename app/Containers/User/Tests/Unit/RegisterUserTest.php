<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Actions\RegisterUserAction;
use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;
use App\Containers\User\UI\API\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\App;

/**
 * Class CreateUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterUserTest extends TestCase
{

    public function testCreateUser_()
    {
        $data = [
            'email'    => 'Mahmoud@test.test',
            'password' => 'so-secret',
            'name'     => 'Mahmoud',
        ];


        $action = App::make(RegisterUserAction::class);
        $user = $action->run($data['email'], $data['password'], $data['name']);

        // asset the returned object is an instance of the User
        $this->assertInstanceOf(User::class, $user);

        $this->assertEquals($user->name, $data['name']);
    }
}
