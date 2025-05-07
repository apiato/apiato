<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Repositories\Concerns;

use App\Containers\AppSection\Authorization\Data\Criteria\WhereGuardCriteria;
use App\Containers\AppSection\Authorization\Data\Repositories\Concerns\InteractsWithGuard;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Ship\Tests\Fakes\TestUser;
use App\Ship\Tests\Fakes\TestUserRepository;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(InteractsWithGuard::class)]
final class InteractsWithGuardTest extends UnitTestCase
{
    public function testItPushesCriteriaWhenGuardIsNotNull(): void
    {
        $repository = new TraitTestRepository();
        $guard = 'web';

        $repository->whereGuard($guard);

        $this->assertSame($guard, $repository->getCriteria()->first()->guard);
        $this->assertContains(WhereGuardCriteria::class, $repository->getCriteria()->map(static fn ($criteria) => get_class($criteria)));
    }

    public function testItDoesNotPushCriteriaWhenGuardIsNull(): void
    {
        $repository = new TraitTestRepository();
        $guard = null;

        $repository->whereGuard($guard);

        $this->assertNotContains(WhereGuardCriteria::class, $repository->getCriteria()->map(static fn ($criteria) => get_class($criteria)));
    }
}

final class TraitTestRepository extends TestUserRepository
{
    use InteractsWithGuard;

    public function model(): string
    {
        return TestUser::class;
    }
}
