<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\BelongsToRelationCriteria;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(BelongsToRelationCriteria::class)]
final class BelongsToRelationCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithEqualCondition(): void
    {
        $repository = app(TestUserRepository::class);
        $belongsToRelationCriteria = new BelongsToRelationCriteria(
            value: 1,
            relationColumn: 'post_id',
            relation: 'posts',
            condition: '='
        );
        $repository->pushCriteria($belongsToRelationCriteria);

        $query = $repository->applyCriteriaAndGetQuery();
        $actualSql = $query->toSql();
        $expectedSql = 'select * from `test_users` where exists (select * from `test_users` as `laravel_reserved_%d` where `test_users`.`id` = `laravel_reserved_%d`.`id` and `post_id` = ? %s) %s';

        self::assertStringMatchesFormat(
            self::normalizeSql($expectedSql),
            self::normalizeSql($actualSql),
        );
        self::assertNotEmpty($query->getQuery()->wheres);
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithDifferentCondition(): void
    {
        $repository = app(TestUserRepository::class);
        $belongsToRelationCriteria = new BelongsToRelationCriteria(
            value: 5,
            relationColumn: 'post_id',
            relation: 'posts',
            condition: '>'
        );
        $repository->pushCriteria($belongsToRelationCriteria);

        $query = $repository->applyCriteriaAndGetQuery();
        $actualSql = $query->toSql();
        $expectedSql = 'select * from `test_users` where exists (select * from `test_users` as `laravel_reserved_%d` where `test_users`.`id` = `laravel_reserved_%d`.`id` and `post_id` > ? %s) %s';

        self::assertStringMatchesFormat(
            self::normalizeSql($expectedSql),
            self::normalizeSql($actualSql),
        );
        self::assertNotEmpty($query->getQuery()->wheres);
    }
}
