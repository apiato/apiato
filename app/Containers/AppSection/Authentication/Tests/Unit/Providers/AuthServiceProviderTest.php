<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Providers;

use App\Containers\AppSection\Authentication\Providers\AuthServiceProvider;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;

#[CoversClass(AuthServiceProvider::class)]
final class AuthServiceProviderTest extends UnitTestCase
{
    #[TestWith(['web'])]
    #[TestWith(['api'])]
    public function testActiveGuardReturnsCorrectGuard(string $guard): void
    {
        $user = User::factory()->createOne();

        $this->assertNull(Auth::activeGuard());

        $this->actingAs($user, $guard);
        $this->assertEquals($guard, Auth::activeGuard());
    }
}
