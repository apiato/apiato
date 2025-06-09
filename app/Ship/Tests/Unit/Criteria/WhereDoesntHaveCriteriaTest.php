<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\WhereDoesntHaveCriteria;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(WhereDoesntHaveCriteria::class)]
final class WhereDoesntHaveCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        $repository = app(TestUserRepository::class);
        $whereDoesntHaveCriteria = new WhereDoesntHaveCriteria(
            relation: 'posts',
            relationColumn: 'title',
            condition: '=',
            value: 'Test Post'
        );
        $repository->pushCriteria($whereDoesntHaveCriteria);

        $query = $repository->applyCriteriaAndGetQuery();
        $actualSql = $query->toSql();
        $expectedSql = 'select * from `test_users` where not exists (select * from `test_users` as `laravel_reserved_%d` where `test_users`.`id` = `laravel_reserved_%d`.`id` and `title` = ? %s) %s';

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
        $whereDoesntHaveCriteria = new WhereDoesntHaveCriteria(
            relation: 'comments',
            relationColumn: 'count',
            condition: '>',
            value: 5
        );
        $repository->pushCriteria($whereDoesntHaveCriteria);

        $query = $repository->applyCriteriaAndGetQuery();
        $actualSql = $query->toSql();
        $expectedSql = 'select * from `test_users` where not exists (select * from `test_users` as `laravel_reserved_%d` where `test_users`.`id` = `laravel_reserved_%d`.`id` and `count` > ? %s) %s';

        self::assertStringMatchesFormat(
            self::normalizeSql($expectedSql),
            self::normalizeSql($actualSql),
        );
        self::assertNotEmpty($query->getQuery()->wheres);
    }

    /**
     * @throws RepositoryException
     */
    public function testDoesntHaveWithCondition(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The relation column must not be empty.');

        $repository = app(TestUserRepository::class);
        $whereDoesntHaveCriteria = new WhereDoesntHaveCriteria(
            relation: 'children',
            relationColumn: '',
            condition: '>',
            value: 2
        );
        $repository->pushCriteria($whereDoesntHaveCriteria);
    }
}
