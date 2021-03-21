<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Actions\RegisterUserAction;
use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;

/**
 * Class CreateUserTest.
 *
 * @group user
 * @group unit
 */
class RegisterUserTest extends TestCase
{
    public function testCreateUser(): void
    {
        $data = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
            'name' => 'Mahmoud',
        ];

        $transporter = new DataTransporter($data);
        $action = App::make(RegisterUserAction::class);
        $user = $action->run($transporter);

        // asset the returned object is an instance of the User
        self::assertInstanceOf(User::class, $user);

        self::assertEquals($user->name, $data['name']);
    }
}
