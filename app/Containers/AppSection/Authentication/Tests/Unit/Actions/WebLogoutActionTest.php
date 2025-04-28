<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\WebLogoutAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(WebLogoutAction::class)]
final class WebLogoutActionTest extends UnitTestCase
{
    public function testLogout(): void
    {
        $user = UserFactory::new()->create();
        $this->actingAs($user, 'web');
        $this->assertEquals(auth()->user()?->getAuthIdentifier(), $user->getKey());
        $action = app(WebLogoutAction::class);

        $action->run();

        $this->assertNotInstanceOf(Authenticatable::class, auth()->user());
    }
}
