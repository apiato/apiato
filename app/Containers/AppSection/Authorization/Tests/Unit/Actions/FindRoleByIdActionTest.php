<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\FindRoleByIdAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindRoleByIdRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(FindRoleByIdAction::class)]
final class FindRoleByIdActionTest extends UnitTestCase
{
    public function testCanFindRole(): void
    {
        $model = RoleFactory::new()->createOne();
        $findRoleByIdRequest = FindRoleByIdRequest::injectData()->withUrlParameters(['role_id' => $model->id]);
        $taskMock = $this->partialMock(FindRoleTask::class);
        $taskMock->expects('run')->once()->with($findRoleByIdRequest->role_id)->andReturn($model);

        app(FindRoleByIdAction::class)->run($findRoleByIdRequest);
    }
}
