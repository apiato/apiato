<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\ListUserPermissionsAction;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListUserPermissionsRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ListUserPermissionsAction::class)]
final class ListUserPermissionsActionTest extends UnitTestCase
{
    public function testCanListPermissions(): void
    {
        $user = UserFactory::new()->createOne()
            ->givePermissionTo(PermissionFactory::new()->count(3)->create());
        $listUserPermissionsRequest = ListUserPermissionsRequest::injectData()->withUrlParameters(['user_id' => $user->id]);
        $action = app(ListUserPermissionsAction::class);

        $result = $action->run($listUserPermissionsRequest);

        $this->assertCount(3, $result);
    }
}
