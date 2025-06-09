<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\ThisGreaterThanOrEqualColumn;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(ThisGreaterThanOrEqualColumn::class)]
final class ThisGreaterThanOrEqualColumnTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithNumericValue(): void
    {
        TestUserFactory::new()->create(['age' => 25]);
        $modelB = TestUserFactory::new()->create(['age' => 30]);
        $modelC = TestUserFactory::new()->create(['age' => 35]);
        $modelD = TestUserFactory::new()->create(['age' => 40]);

        $repository = app(TestUserRepository::class);
        $thisGreaterThanOrEqualColumn = new ThisGreaterThanOrEqualColumn('age', 30);
        $repository->pushCriteria($thisGreaterThanOrEqualColumn);

        $result = $repository->all();

        self::assertCount(3, $result);
        self::assertEquals([$modelB->id, $modelC->id, $modelD->id], $result->pluck('id')->toArray());
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithStringValue(): void
    {
        $modelA = TestUserFactory::new()->create(['name' => 'C']);
        $modelB = TestUserFactory::new()->create(['name' => 'D']);
        $modelC = TestUserFactory::new()->create(['name' => 'E']);
        TestUserFactory::new()->create(['name' => 'A']);
        TestUserFactory::new()->create(['name' => 'B']);

        $repository = app(TestUserRepository::class);
        $thisGreaterThanOrEqualColumn = new ThisGreaterThanOrEqualColumn('name', 'C');
        $repository->pushCriteria($thisGreaterThanOrEqualColumn);

        $result = $repository->all();

        self::assertCount(3, $result);
        self::assertEquals([$modelA->id, $modelB->id, $modelC->id], $result->pluck('id')->toArray());
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithFloatValue(): void
    {
        TestUserFactory::new()->create(['score' => 3.5]);
        $modelA = TestUserFactory::new()->create(['score' => 4.5]);
        $modelB = TestUserFactory::new()->create(['score' => 4.6]);
        $modelC = TestUserFactory::new()->create(['score' => 5.0]);

        $repository = app(TestUserRepository::class);
        $thisGreaterThanOrEqualColumn = new ThisGreaterThanOrEqualColumn('score', 4.5);
        $repository->pushCriteria($thisGreaterThanOrEqualColumn);

        $result = $repository->all();

        self::assertCount(3, $result);
        self::assertEquals([$modelA->id, $modelB->id, $modelC->id], $result->pluck('id')->toArray());
    }
}
