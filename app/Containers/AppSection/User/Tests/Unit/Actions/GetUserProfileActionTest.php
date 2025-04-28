<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\Actions;

use App\Containers\AppSection\User\Actions\GetUserProfileAction;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(GetUserProfileAction::class)]
final class GetUserProfileActionTest extends UnitTestCase
{
    public function testCanGetUserProfile(): void
    {
        $model = UserFactory::new()->createOne();
        auth()->setUser($model);
        $action = app(GetUserProfileAction::class);

        $foundUser = $action->run();

        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertSame($model->id, $foundUser->id);
    }
}
