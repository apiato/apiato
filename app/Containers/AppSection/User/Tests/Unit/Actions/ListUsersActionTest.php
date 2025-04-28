<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\Actions;

use App\Containers\AppSection\User\Actions\ListUsersAction;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ListUsersAction::class)]
final class ListUsersActionTest extends UnitTestCase
{
    public function testCanListUsers(): void
    {
        UserFactory::new()->count(2)->create();
        $task = app(ListUsersAction::class);

        $foundUsers = $task->run();

        $this->assertCount(3, $foundUsers);
    }
}
