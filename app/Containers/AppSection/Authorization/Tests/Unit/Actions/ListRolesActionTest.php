<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\ListRolesAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(ListRolesAction::class)]
final class ListRolesActionTest extends UnitTestCase
{
    public function testCanListRoles(): void
    {
        RoleFactory::new()->count(2)->create();
        $action = app(ListRolesAction::class);

        $result = $action->run();

        $this->assertCount(4, $result);
    }
}
