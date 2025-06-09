<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\RegisterUserAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RegisterUserAction::class)]
final class RegisterUserActionTest extends UnitTestCase
{
    public function testRegisterUser(): void
    {
        Notification::fake();
        Event::fake();
        $data = [
            'email'    => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        $action = app(RegisterUserAction::class);

        $user = $action->run($data);

        $this->assertModelExists($user);
        self::assertInstanceOf(User::class, $user);
        self::assertSame(strtolower($data['email']), $user->email);
        self::assertTrue(Hash::check($data['password'], $user->password));
        self::assertNull($user->email_verified_at);
        Event::assertDispatched(Registered::class, static fn (Registered $event) => $event->user->is($user));
    }
}
