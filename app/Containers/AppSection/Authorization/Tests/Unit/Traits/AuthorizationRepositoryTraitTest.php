<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Traits;

use App\Containers\AppSection\Authorization\Data\Criterias\WhereGuardCriteria;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\Traits\AuthorizationRepositoryTrait;
use App\Ship\Tests\Fakes\TestUser;
use App\Ship\Tests\Fakes\TestUserRepository;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(AuthorizationRepositoryTrait::class)]
final class AuthorizationRepositoryTraitTest extends UnitTestCase
{
    public function testItPushesCriteriaWhenGuardIsNotNull(): void
    {
        $repository = new TraitTestRepository(app());
        $guard = 'web';

        $repository->whereGuard($guard);

        $this->assertSame($guard, $this->getInaccessiblePropertyValue($repository->getCriteria()->first(), 'guard'));
        $this->assertContains(WhereGuardCriteria::class, $repository->getCriteria()->map(static fn ($criteria) => get_class($criteria)));
    }

    public function testItDoesNotPushCriteriaWhenGuardIsNull(): void
    {
        $repository = new TraitTestRepository(app());
        $guard = null;

        $repository->whereGuard($guard);

        $this->assertNotContains(WhereGuardCriteria::class, $repository->getCriteria()->map(static fn ($criteria) => get_class($criteria)));
    }
}

class TraitTestRepository extends TestUserRepository
{
    use AuthorizationRepositoryTrait;

    public function model(): string
    {
        return TestUser::class;
    }
}
