<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\WhereHasNullCriteria;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(WhereHasNullCriteria::class)]
final class WhereHasNullCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        $repository = app(TestUserRepository::class);
        $whereHasNullCriteria = new WhereHasNullCriteria('email', 'posts');
        $repository->pushCriteria($whereHasNullCriteria);

        $query = $repository->applyCriteriaAndGetQuery();
        $actualSql = $query->toSql();
        $expectedSql = 'select * from `test_users` where exists (select * from `test_users` as `laravel_reserved_%d` where `test_users`.`id` = `laravel_reserved_%d`.`id` and `email` is null %s) %s';

        self::assertStringMatchesFormat(
            self::normalizeSql($expectedSql),
            self::normalizeSql($actualSql),
        );
        self::assertNotEmpty($query->getQuery()->wheres);
    }
}
