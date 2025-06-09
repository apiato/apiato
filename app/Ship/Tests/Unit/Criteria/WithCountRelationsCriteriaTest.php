<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\WithCountRelationsCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(WithCountRelationsCriteria::class)]
final class WithCountRelationsCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithSingleRelation(): void
    {
        TestUserFactory::new()->create();

        $repository = app(TestUserRepository::class);
        $withCountRelationsCriteria = new WithCountRelationsCriteria('posts');
        $repository->pushCriteria($withCountRelationsCriteria);

        $query = $repository->applyCriteriaAndGetQuery();
        $actualSql = $query->toSql();
        $expectedSql = 'select `test_users`.*, (select count(*) from `test_users` as `laravel_reserved_%d` %s) as `posts_count` %s';

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
        $withCountRelationsCriteria = new WithCountRelationsCriteria(['posts', 'comments']);
        $repository->pushCriteria($withCountRelationsCriteria);

        $query = $repository->applyCriteriaAndGetQuery();
        $actualSql = $query->toSql();
        $expectedSql = 'select `test_users`.*, (select count(*) from `test_users` as `laravel_reserved_%d` %s) as `posts_count`, (select count(*) from `test_users` as `laravel_reserved_%d` %s) as `comments_count` %s';

        self::assertStringMatchesFormat(
            self::normalizeSql($expectedSql),
            self::normalizeSql($actualSql),
        );
    }
}
