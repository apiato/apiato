<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Repositories\Concerns;

use App\Containers\AppSection\Authorization\Data\Criteria\WhereGuardCriteria;
use App\Containers\AppSection\Authorization\Data\Repositories\Concerns\InteractsWithGuard;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(InteractsWithGuard::class)]
final class InteractsWithGuardTest extends UnitTestCase
{
    public function testItPushesCriteriaWhenGuardIsNotNull(): void
    {
        $traitTestRepository = new TraitTestRepository();
        $guard = 'web';

        $traitTestRepository->whereGuard($guard);

        self::assertSame($guard, $traitTestRepository->getCriteria()->first()->guard);
        self::assertContains(WhereGuardCriteria::class, $traitTestRepository->getCriteria()->map(static fn ($criteria): string|false => $criteria::class));
    }

    public function testItDoesNotPushCriteriaWhenGuardIsNull(): void
    {
        $traitTestRepository = new TraitTestRepository();
        $guard = null;

        $traitTestRepository->whereGuard($guard);

        self::assertNotContains(WhereGuardCriteria::class, $traitTestRepository->getCriteria()->map(static fn ($criteria): string|false => $criteria::class));
    }
}
