<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\DeleteRoleAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\DeleteRoleRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(DeleteRoleAction::class)]
final class DeleteRoleActionTest extends UnitTestCase
{
    public function testCanDeleteRole(): void
    {
        $role = RoleFactory::new()->createOne();
        $request = DeleteRoleRequest::injectData()->withUrlParameters(['id' => $role->id]);
        $action = app(DeleteRoleAction::class);
        $this->assertModelExists($role);

        $action->run($request);

        $this->assertModelMissing($role);
    }

    public function testDeleteRoleWitInvalidIdThrows404(): void
    {
        $this->expectException(NotFoundException::class);

        $invalidId = 7777777;
        $request = DeleteRoleRequest::injectData()
            ->withUrlParameters(['id' => $invalidId]);

        app(DeleteRoleAction::class)->run($request);
    }

    public function testDeleteRoleActionThrowsDeleteResourceFailedException(): void
    {
        $this->expectException(DeleteResourceFailedException::class);

        $mockRepository = $this->mock(RoleRepository::class);
        $mockRepository->allows()->delete()->andThrow(new \Exception());
        $action = new DeleteRoleAction($mockRepository);
        $request = DeleteRoleRequest::injectData();

        $action->run($request);
    }
}
