<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\WebLogoutAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(WebLogoutAction::class)]
class WebLogoutActionTest extends UnitTestCase
{
    public function testLogout(): void
    {
        $user = UserFactory::new()->create();
        $this->actingAs($user, 'web');
        $this->assertEquals(auth()->user()->id, $user->id);
        $action = app(WebLogoutAction::class);

        $action->run();

        $this->assertNull(auth()->user());
    }
}
