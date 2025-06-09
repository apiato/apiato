<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\WithoutRelationsCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(WithoutRelationsCriteria::class)]
final class WithoutRelationsCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithSingleRelation(): void
    {
        TestUserFactory::new()->create();

        $repository = app(TestUserRepository::class);

        $repository->with('posts');

        $withoutRelationsCriteria = new WithoutRelationsCriteria('posts');
        $repository->pushCriteria($withoutRelationsCriteria);

        $query = $repository->applyCriteriaAndGetQuery();

        self::assertArrayNotHasKey('posts', $query->getEagerLoads());
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithMultipleRelations(): void
    {
        TestUserFactory::new()->create();

        $repository = app(TestUserRepository::class);

        $repository->with(['posts', 'comments']);

        $withoutRelationsCriteria = new WithoutRelationsCriteria(['posts']);
        $repository->pushCriteria($withoutRelationsCriteria);

        $query = $repository->applyCriteriaAndGetQuery();

        self::assertArrayNotHasKey('posts', $query->getEagerLoads());
        self::assertArrayHasKey('comments', $query->getEagerLoads());
    }
}
