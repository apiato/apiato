<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\WithExistsRelationsCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(WithExistsRelationsCriteria::class)]
final class WithExistsRelationsCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithSingleRelation(): void
    {
        TestUserFactory::new()->create();

        $repository = app(TestUserRepository::class);
        $withExistsRelationsCriteria = new WithExistsRelationsCriteria('posts');
        $repository->pushCriteria($withExistsRelationsCriteria);

        $query = $repository->applyCriteriaAndGetQuery();
        $actualSql = $query->toSql();
        $expectedSql = 'select `test_users`.*, exists(select * from `test_users` as `laravel_reserved_%d` %s) as `posts_exists` %s';

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
        $withExistsRelationsCriteria = new WithExistsRelationsCriteria(['posts', 'comments']);
        $repository->pushCriteria($withExistsRelationsCriteria);

        $query = $repository->applyCriteriaAndGetQuery();
        $actualSql = $query->toSql();
        $expectedSql = 'select `test_users`.*, exists(select * from `test_users` as `laravel_reserved_%d` %s) as `posts_exists`, exists(select * from `test_users` as `laravel_reserved_%d` %s) as `comments_exists` %s';

        self::assertStringMatchesFormat(
            self::normalizeSql($expectedSql),
            self::normalizeSql($actualSql),
        );
    }
}
