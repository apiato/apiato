<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\ThisLessThanOrEqualColumn;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(ThisLessThanOrEqualColumn::class)]
final class ThisLessThanOrEqualColumnTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithNumericValue(): void
    {
        $modelA = TestUserFactory::new()->create(['age' => 25]);
        $modelB = TestUserFactory::new()->create(['age' => 28]);
        $modelC = TestUserFactory::new()->create(['age' => 30]);
        TestUserFactory::new()->create(['age' => 35]);
        TestUserFactory::new()->create(['age' => 40]);

        $repository = app(TestUserRepository::class);
        $thisLessThanOrEqualColumn = new ThisLessThanOrEqualColumn('age', 30);
        $repository->pushCriteria($thisLessThanOrEqualColumn);

        $result = $repository->all();

        self::assertCount(3, $result);
        self::assertEquals([$modelA->id, $modelB->id, $modelC->id], $result->pluck('id')->toArray());
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithStringValue(): void
    {
        TestUserFactory::new()->create(['name' => 'D']);
        TestUserFactory::new()->create(['name' => 'E']);
        $modelA = TestUserFactory::new()->create(['name' => 'A']);
        $modelB = TestUserFactory::new()->create(['name' => 'B']);
        $modelC = TestUserFactory::new()->create(['name' => 'C']);

        $repository = app(TestUserRepository::class);
        $thisLessThanOrEqualColumn = new ThisLessThanOrEqualColumn('name', 'C');
        $repository->pushCriteria($thisLessThanOrEqualColumn);

        $result = $repository->all();

        self::assertCount(3, $result);
        self::assertEquals([$modelA->id, $modelB->id, $modelC->id], $result->pluck('id')->toArray());
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithFloatValue(): void
    {
        $modelA = TestUserFactory::new()->create(['score' => 3.5]);
        $modelB = TestUserFactory::new()->create(['score' => 4.2]);
        $modelC = TestUserFactory::new()->create(['score' => 4.5]);
        TestUserFactory::new()->create(['score' => 4.6]);
        TestUserFactory::new()->create(['score' => 5.0]);

        $repository = app(TestUserRepository::class);
        $thisLessThanOrEqualColumn = new ThisLessThanOrEqualColumn('score', 4.5);
        $repository->pushCriteria($thisLessThanOrEqualColumn);

        $result = $repository->all();

        self::assertCount(3, $result);
        self::assertEquals([$modelA->id, $modelB->id, $modelC->id], $result->pluck('id')->toArray());
    }
}
