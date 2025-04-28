<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criterias;

use App\Ship\Criterias\OrderByFieldCriteria;
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
        $orderByFieldCriteria = new OrderByFieldCriteria('name', 'asc');
        $repository->pushCriteria($orderByFieldCriteria);

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
        $orderByFieldCriteria = new OrderByFieldCriteria('name', 'desc');
        $repository->pushCriteria($orderByFieldCriteria);

        $result = $repository->all();

        $this->assertSame($modelC->id, $result->first()->id);
        $this->assertSame($modelB->id, $result->get(1)->id);
        $this->assertSame($modelA->id, $result->last()->id);
    }

    public function testCriteriaThrowExceptionWhenSortOrderIsWrong(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $repository = app(TestUserRepository::class);
        $orderByFieldCriteria = new OrderByFieldCriteria('name', 'wrong');
        $repository->pushCriteria($orderByFieldCriteria);
    }
}
