<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\DeleteRoleAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\DeleteRoleRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(DeleteRoleAction::class)]
final class DeleteRoleActionTest extends UnitTestCase
{
    public function testCanDeleteRole(): void
    {
        $model = RoleFactory::new()->createOne();
        $deleteRoleRequest = DeleteRoleRequest::injectData()->withUrlParameters(['role_id' => $model->id]);
        $action = app(DeleteRoleAction::class);
        $this->assertModelExists($model);

        $result = $action->run($deleteRoleRequest);

        $this->assertTrue($result);
        $this->assertModelMissing($model);
    }
}
