<?php

declare(strict_types=1);

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
        self::assertTrue($session->has('key'));
        self::assertSame('value', $session->get('key'));
        $sessionId = $session->getId();
        $csrfToken = $session->token();

        $action->run($session);

        self::assertFalse(auth('web')->check());
        self::assertFalse($session->has('key'));
        $this->assertNotSame($sessionId, $session->getId());
        $this->assertNotSame($csrfToken, $session->token());
    }
}
