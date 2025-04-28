<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Parents\Models;

use App\Ship\Parents\Models\UserModel;
use App\Ship\Tests\Fakes\TestUser;
use App\Ship\Tests\ShipTestCase;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use PHPUnit\Framework\Attributes\CoversClass;
use Spatie\Permission\Traits\HasRoles;

#[CoversClass(UserModel::class)]
final class UserModelTest extends ShipTestCase
{
    public function testClassUsesCorrectTraits(): void
    {
        $this->assertContains(Notifiable::class, class_uses_recursive(TestUser::class));
        $this->assertContains(HasApiTokens::class, class_uses_recursive(TestUser::class));
        $this->assertContains(HasRoles::class, class_uses_recursive(TestUser::class));
    }
}
