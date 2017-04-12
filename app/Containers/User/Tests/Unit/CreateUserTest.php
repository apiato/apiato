<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Models\User;
use App\Containers\User\Actions\CreateUserAction;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;

/**
 * Class CreateUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateUserTest extends TestCase
{

    public function testCreateUser_()
    {
        $task = App::make(CreateUserAction::class);

        $email = 'Mahmoud@test.test';
        $name = 'Mahmoud';
        $password = 'so-secret';

        $user = $task->run($email, $password, $name, null, null, true);

        // asset the returned object is an instance of the User
        $this->assertInstanceOf(User::class, $user);

        $this->assertEquals($user->name, $name);
    }
}
