<?php

namespace App\Containers\User\Tests\Api\Unit;

use App\Containers\User\Models\User;
use App\Containers\User\Tasks\CreateUserTask;
use App\Kernel\Tests\PHPUnit\Abstracts\TestCase;
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
        $Task = App::make(CreateUserTask::class);

        $name = 'Mahmoud';

        $user = $Task->run($name, true);

        // asset the returned object is an instance of the User
        $this->assertInstanceOf(User::class, $user);

        // assert the user has logged in and has a token attached to it
        $this->assertNotEmpty($user->token);

        $this->assertEquals($user->name, $name);
    }
}
