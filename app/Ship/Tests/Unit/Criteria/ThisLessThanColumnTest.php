<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\ThisLessThanColumn;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(ThisLessThanColumn::class)]
final class ThisLessThanColumnTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithNumericValue(): void
    {
        $modelA = TestUserFactory::new()->create(['age' => 25]);
        $modelB = TestUserFactory::new()->create(['age' => 28]);
        TestUserFactory::new()->create(['age' => 35]);
        TestUserFactory::new()->create(['age' => 40]);

        $repository = app(TestUserRepository::class);
        $thisLessThanColumn = new ThisLessThanColumn('age', 30);
        $repository->pushCriteria($thisLessThanColumn);

        $result = $repository->all();

        self::assertCount(2, $result);
        self::assertEquals([$modelA->id, $modelB->id], $result->pluck('id')->toArray());
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

        $repository = app(TestUserRepository::class);
        $thisLessThanColumn = new ThisLessThanColumn('name', 'C');
        $repository->pushCriteria($thisLessThanColumn);

        $result = $repository->all();

        self::assertCount(2, $result);
        self::assertEquals([$modelA->id, $modelB->id], $result->pluck('id')->toArray());
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithFloatValue(): void
    {
        $modelA = TestUserFactory::new()->create(['score' => 3.5]);
        $modelB = TestUserFactory::new()->create(['score' => 4.2]);
        TestUserFactory::new()->create(['score' => 4.6]);
        TestUserFactory::new()->create(['score' => 5.0]);

        $repository = app(TestUserRepository::class);
        $thisLessThanColumn = new ThisLessThanColumn('score', 4.5);
        $repository->pushCriteria($thisLessThanColumn);

        $result = $repository->all();

        self::assertCount(2, $result);
        self::assertEquals([$modelA->id, $modelB->id], $result->pluck('id')->toArray());
    }
}
