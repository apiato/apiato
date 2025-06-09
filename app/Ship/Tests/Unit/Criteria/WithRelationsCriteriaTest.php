<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\WithRelationsCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(WithRelationsCriteria::class)]
final class WithRelationsCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithSingleRelation(): void
    {
        TestUserFactory::new()->create();

        $repository = app(TestUserRepository::class);
        $withRelationsCriteria = new WithRelationsCriteria('posts');
        $repository->pushCriteria($withRelationsCriteria);

        $query = $repository->applyCriteriaAndGetQuery();
        $eagerLoads = $query->getEagerLoads();

        self::assertArrayHasKey('posts', $eagerLoads);
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithMultipleRelations(): void
    {
        TestUserFactory::new()->create();

        $repository = app(TestUserRepository::class);
        $withRelationsCriteria = new WithRelationsCriteria(['posts', 'comments']);
        $repository->pushCriteria($withRelationsCriteria);

        $query = $repository->applyCriteriaAndGetQuery();
        $eagerLoads = $query->getEagerLoads();

        self::assertArrayHasKey('posts', $eagerLoads);
        self::assertArrayHasKey('comments', $eagerLoads);
    }
}
