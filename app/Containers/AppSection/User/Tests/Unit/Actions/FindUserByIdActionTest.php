<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\Actions;

use App\Containers\AppSection\User\Actions\FindUserByIdAction;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Containers\AppSection\User\UI\API\Requests\FindUserByIdRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(FindUserByIdAction::class)]
final class FindUserByIdActionTest extends UnitTestCase
{
    public function testCanDeleteUser(): void
    {
        $model = UserFactory::new()->createOne();
        $findUserByIdRequest = FindUserByIdRequest::injectData()->withUrlParameters(['user_id' => $model->id]);
        $action = app(FindUserByIdAction::class);

        $result = $action->run($findUserByIdRequest);

        $this->assertSame($model->id, $result->id);
    }
}
