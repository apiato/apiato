<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\FindPermissionByIdAction;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindPermissionByIdRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(FindPermissionByIdAction::class)]
final class FindPermissionByIdActionTest extends UnitTestCase
{
    public function testCanFindPermission(): void
    {
        $model = PermissionFactory::new()->createOne();
        $findPermissionByIdRequest = FindPermissionByIdRequest::injectData()->withUrlParameters(['permission_id' => $model->id]);
        $repositoryMock = $this->partialMock(PermissionRepository::class);
        $repositoryMock->expects('getById')->once()->with($findPermissionByIdRequest->permission_id)->andReturn($model);

        app(FindPermissionByIdAction::class)->run($findPermissionByIdRequest);
    }
}
