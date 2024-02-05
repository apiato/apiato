<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\GivePermissionsToUserAction;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\GivePermissionsToUserRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(GivePermissionsToUserAction::class)]
final class GivePermissionsToUserActionTest extends UnitTestCase
{
    public function testCanGiveSinglePermission(): void
    {
        $user = UserFactory::new()->createOne();
        $permission = PermissionFactory::new()->createOne();
        $data = [
            'permission_ids' => [$permission->getHashedKey()],
        ];
        $request = GivePermissionsToUserRequest::injectData($data)->withUrlParameters(['id' => $user->id]);
        $action = app(GivePermissionsToUserAction::class);

        $result = $action->run($request);

        $this->assertSame($result->id, $user->id);
        $this->assertTrue($result->hasPermissionTo($permission->name));
    }

    public function testCanGiveMultiplePermissions(): void
    {
        $user = UserFactory::new()->createOne();
        $permissionA = PermissionFactory::new()->createOne();
        $permissionB = PermissionFactory::new()->createOne();
        $data = [
            'permission_ids' => [$permissionA->getHashedKey(), $permissionB->getHashedKey()],
        ];
        $request = GivePermissionsToUserRequest::injectData($data)->withUrlParameters(['id' => $user->id]);
        $action = app(GivePermissionsToUserAction::class);

        $result = $action->run($request);

        $this->assertSame($result->id, $user->id);
        $this->assertTrue($result->hasAllPermissions([$permissionA->name, $permissionB->name]));
    }
}
