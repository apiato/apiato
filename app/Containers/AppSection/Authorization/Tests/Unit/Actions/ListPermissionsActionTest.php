<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\ListPermissionsAction;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(ListPermissionsAction::class)]
final class ListPermissionsActionTest extends UnitTestCase
{
    public function testCanListPermissions(): void
    {
        PermissionFactory::new()->count(3)->create();
        $action = app(ListPermissionsAction::class);

        $result = $action->run();

        $this->assertCount(10, $result);
    }
}
