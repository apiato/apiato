<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\GivePermissionsToUserAction;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\GivePermissionsToUserRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(GivePermissionsToUserAction::class)]
final class GivePermissionsToUserActionTest extends UnitTestCase
{
    public function testCanGiveSinglePermission(): void
    {
        $model = UserFactory::new()->createOne();
        $permission = PermissionFactory::new()->createOne();
        $data = [
            'permission_ids' => [$permission->getHashedKey()],
        ];
        $givePermissionsToUserRequest = GivePermissionsToUserRequest::injectData($data)->withUrlParameters(['user_id' => $model->id]);
        $action = app(GivePermissionsToUserAction::class);

        $result = $action->run($givePermissionsToUserRequest);

        $this->assertSame($result->id, $model->id);
        $this->assertTrue($result->hasPermissionTo($permission->name));
    }

    public function testCanGiveMultiplePermissions(): void
    {
        $model = UserFactory::new()->createOne();
        $permissionA = PermissionFactory::new()->createOne();
        $permissionB = PermissionFactory::new()->createOne();
        $data = [
            'permission_ids' => [$permissionA->getHashedKey(), $permissionB->getHashedKey()],
        ];
        $givePermissionsToUserRequest = GivePermissionsToUserRequest::injectData($data)->withUrlParameters(['user_id' => $model->id]);
        $action = app(GivePermissionsToUserAction::class);

        $result = $action->run($givePermissionsToUserRequest);

        $this->assertSame($result->id, $model->id);
        $this->assertTrue($result->hasAllPermissions([$permissionA->name, $permissionB->name]));
    }
}
