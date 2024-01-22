<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\ListUserPermissionsAction;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListUserPermissionsRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(ListUserPermissionsAction::class)]
final class ListUserPermissionsActionTest extends UnitTestCase
{
    public function testCanListPermissions(): void
    {
        $user = UserFactory::new()->createOne()
            ->givePermissionTo(PermissionFactory::new()->count(3)->create());
        $request = ListUserPermissionsRequest::injectData()->withUrlParameters(['id' => $user->id]);
        $action = app(ListUserPermissionsAction::class);

        $result = $action->run($request);

        $this->assertCount(3, $result);
    }
}
