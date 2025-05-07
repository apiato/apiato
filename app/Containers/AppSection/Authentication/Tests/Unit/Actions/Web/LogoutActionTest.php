<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\Web;

use App\Containers\AppSection\Authentication\Actions\Web\LogoutAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Session;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(LogoutAction::class)]
final class LogoutActionTest extends UnitTestCase
{
    public function testLogout(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'web');
        $this->assertAuthenticated('web');
        $action = app(LogoutAction::class);
        Session::put('key', 'value');
        $session = app('session.store');
        $this->assertTrue($session->has('key'));
        $this->assertSame('value', $session->get('key'));
        $sessionId = $session->getId();
        $csrfToken = $session->token();

        $action->run($session);

        $this->assertFalse(auth('web')->check());
        $this->assertFalse($session->has('key'));
        $this->assertNotSame($sessionId, $session->getId());
        $this->assertNotSame($csrfToken, $session->token());
    }
}
