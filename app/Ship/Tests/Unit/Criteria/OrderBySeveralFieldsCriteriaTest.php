<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\OrderBySeveralFieldsCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(OrderBySeveralFieldsCriteria::class)]
final class OrderBySeveralFieldsCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        TestUserFactory::new()->create(['name' => 'C']);
        TestUserFactory::new()->create(['name' => 'A']);
        TestUserFactory::new()->create(['name' => 'B']);

        $repository = app(TestUserRepository::class);
        $orderBySeveralFieldsCriteria = new OrderBySeveralFieldsCriteria('name', ['B', 'A', 'C']);
        $repository->pushCriteria($orderBySeveralFieldsCriteria);

        $query = $repository->applyCriteriaAndGetQuery();
        $actualSql = $query->toSql();
        $expectedSql = 'select * from `test_users`%s order by CASE WHEN `name` = ? THEN ? WHEN `name` = ? THEN ? WHEN `name` = ? THEN ? ELSE ? END';

        self::assertStringMatchesFormat(
            self::normalizeSql($expectedSql),
            self::normalizeSql($actualSql),
        );
        self::assertEquals(['B', 0, 'A', 1, 'C', 2, 4], $query->getBindings());

        $result = $repository->all();
        self::assertEquals('B', $result[0]->name);
        self::assertEquals('A', $result[1]->name);
        self::assertEquals('C', $result[2]->name);
    }
}
