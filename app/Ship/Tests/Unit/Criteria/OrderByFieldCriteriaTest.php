<?php

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\OrderByFieldCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(OrderByFieldCriteria::class)]
final class OrderByFieldCriteriaTest extends ShipTestCase
{
    public function testCriteriaAscending(): void
    {
        $modelB = TestUserFactory::new()->create(['name' => 'B']);
        $modelA = TestUserFactory::new()->create(['name' => 'A']);
        $modelC = TestUserFactory::new()->create(['name' => 'C']);

        $repository = app(TestUserRepository::class);
        $criteria = new OrderByFieldCriteria('name', 'asc');
        $repository->pushCriteria($criteria);

        $result = $repository->all();

        $this->assertSame($modelA->id, $result->first()->id);
        $this->assertSame($modelB->id, $result->get(1)->id);
        $this->assertSame($modelC->id, $result->last()->id);
    }

    public function testCriteriaDescending(): void
    {
        $modelB = TestUserFactory::new()->create(['name' => 'B']);
        $modelA = TestUserFactory::new()->create(['name' => 'A']);
        $modelC = TestUserFactory::new()->create(['name' => 'C']);

        $repository = app(TestUserRepository::class);
        $criteria = new OrderByFieldCriteria('name', 'desc');
        $repository->pushCriteria($criteria);

        $result = $repository->all();

        $this->assertSame($modelC->id, $result->first()->id);
        $this->assertSame($modelB->id, $result->get(1)->id);
        $this->assertSame($modelA->id, $result->last()->id);
    }

    public function testCriteriaThrowExceptionWhenSortOrderIsWrong(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $repository = app(TestUserRepository::class);
        $criteria = new OrderByFieldCriteria('name', 'wrong');
        $repository->pushCriteria($criteria);
    }
}
