<?php

namespace App\Containers\AppSection\User\Tests\Unit\Actions;

use App\Containers\AppSection\User\Actions\FindUserByIdAction;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(FindUserByIdAction::class)]
final class FindUserByIdActionTest extends UnitTestCase
{
    public function testCanDeleteUser(): void
    {
        $user = User::factory()->createOne();
        $action = app(FindUserByIdAction::class);

        $result = $action->run($user->id);

        $this->assertSame($user->id, $result->id);
    }
}
