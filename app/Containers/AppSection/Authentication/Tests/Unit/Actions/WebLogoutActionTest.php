<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\WebLogoutAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(WebLogoutAction::class)]
class WebLogoutActionTest extends UnitTestCase
{
    public function testLogout(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'web');
        $this->assertAuthenticated('web');
        $action = app(WebLogoutAction::class);

        $action->run();

        $this->assertFalse(auth('web')->check());
    }
}
