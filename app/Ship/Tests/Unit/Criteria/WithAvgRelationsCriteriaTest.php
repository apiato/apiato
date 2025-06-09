<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\WithAvgRelationsCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(WithAvgRelationsCriteria::class)]
final class WithAvgRelationsCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithSingleRelation(): void
    {
        TestUserFactory::new()->create();

        $repository = app(TestUserRepository::class);
        $withAvgRelationsCriteria = new WithAvgRelationsCriteria('posts', 'rating');
        $repository->pushCriteria($withAvgRelationsCriteria);

        $query = $repository->applyCriteriaAndGetQuery();
        $actualSql = $query->toSql();
        $expectedSql = 'select `test_users`.*, (select avg(`laravel_reserved_%d`.`rating`) from `test_users` as `laravel_reserved_%d` %s) as `posts_avg_rating` from `test_users` %s';

        self::assertStringMatchesFormat(
            self::normalizeSql($expectedSql),
            self::normalizeSql($actualSql),
        );
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithMultipleRelations(): void
    {
        TestUserFactory::new()->create();

        $repository = app(TestUserRepository::class);
        $withAvgRelationsCriteria = new WithAvgRelationsCriteria(['posts', 'comments'], 'score');
        $repository->pushCriteria($withAvgRelationsCriteria);

        $query = $repository->applyCriteriaAndGetQuery();
        $actualSql = $query->toSql();
        $expectedSql = 'select `test_users`.*, (select avg(`laravel_reserved_%d`.`score`) from `test_users` as `laravel_reserved_%d` %s) as `posts_avg_score`, (select avg(`laravel_reserved_%d`.`score`) from `test_users` as `laravel_reserved_%d` %s) as `comments_avg_score` from `test_users` %s';

        self::assertStringMatchesFormat(
            self::normalizeSql($expectedSql),
            self::normalizeSql($actualSql),
        );
    }
}
