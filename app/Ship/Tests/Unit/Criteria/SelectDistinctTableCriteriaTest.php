<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\SelectDistinctTableCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(SelectDistinctTableCriteria::class)]
final class SelectDistinctTableCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithSpecificFields(): void
    {
        TestUserFactory::new()->create(['name' => 'A', 'email' => 'a@test.com']);
        TestUserFactory::new()->create(['name' => 'A', 'email' => 'another@test.com']);
        TestUserFactory::new()->create(['name' => 'B', 'email' => 'b@test.com']);

        $repository = app(TestUserRepository::class);
        $selectDistinctTableCriteria = new SelectDistinctTableCriteria(['name']);
        $repository->pushCriteria($selectDistinctTableCriteria);

        $query = $repository->applyCriteriaAndGetQuery();

        $actualSql = $query->toSql();
        $expectedSql = 'select distinct `test_users`.`name` from `test_users`';
        self::assertStringContainsString(
            self::normalizeSql($expectedSql),
            self::normalizeSql($actualSql),
        );

        $result = $repository->all();
        self::assertCount(2, $result);
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithDefaultFields(): void
    {
        TestUserFactory::new()->create(['name' => 'A', 'email' => 'a@test.com']);
        TestUserFactory::new()->create(['name' => 'A', 'email' => 'a@test.com']); // Duplicate
        TestUserFactory::new()->create(['name' => 'B', 'email' => 'b@test.com']);

        $repository = app(TestUserRepository::class);
        $selectDistinctTableCriteria = new SelectDistinctTableCriteria();
        $repository->pushCriteria($selectDistinctTableCriteria);

        $query = $repository->applyCriteriaAndGetQuery();

        $actualSql = $query->toSql();
        $expectedSql = 'select distinct `test_users`.* from `test_users`';
        self::assertStringContainsString(
            self::normalizeSql($expectedSql),
            self::normalizeSql($actualSql),
        );
    }
}
