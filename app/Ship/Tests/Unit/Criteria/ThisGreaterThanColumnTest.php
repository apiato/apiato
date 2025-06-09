<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\ThisGreaterThanColumn;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(ThisGreaterThanColumn::class)]
final class ThisGreaterThanColumnTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithNumericValue(): void
    {
        TestUserFactory::new()->create(['age' => 25]);
        $modelB = TestUserFactory::new()->create(['age' => 35]);
        $modelC = TestUserFactory::new()->create(['age' => 40]);

        $repository = app(TestUserRepository::class);
        $thisGreaterThanColumn = new ThisGreaterThanColumn('age', 30);
        $repository->pushCriteria($thisGreaterThanColumn);

        $result = $repository->all();

        self::assertCount(2, $result);
        self::assertEquals([$modelB->id, $modelC->id], $result->pluck('id')->toArray());
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithStringValue(): void
    {
        $modelA = TestUserFactory::new()->create(['name' => 'D']);
        $modelB = TestUserFactory::new()->create(['name' => 'E']);
        TestUserFactory::new()->create(['name' => 'A']);
        TestUserFactory::new()->create(['name' => 'B']);

        $repository = app(TestUserRepository::class);
        $thisGreaterThanColumn = new ThisGreaterThanColumn('name', 'C');
        $repository->pushCriteria($thisGreaterThanColumn);

        $result = $repository->all();

        self::assertCount(2, $result);
        self::assertEquals([$modelA->id, $modelB->id], $result->pluck('id')->toArray());
    }
}
