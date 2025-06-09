<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\OrderByFieldCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(OrderByFieldCriteria::class)]
final class OrderByFieldCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteriaAscending(): void
    {
        $modelB = TestUserFactory::new()->create(['name' => 'B']);
        $modelA = TestUserFactory::new()->create(['name' => 'A']);
        $modelC = TestUserFactory::new()->create(['name' => 'C']);

        $repository = app(TestUserRepository::class);
        $orderByFieldCriteria = new OrderByFieldCriteria('name', 'asc');
        $repository->pushCriteria($orderByFieldCriteria);

        $result = $repository->all();

        self::assertSame($modelA->id, $result->first()->id);
        self::assertSame($modelB->id, $result->get(1)->id);
        self::assertSame($modelC->id, $result->last()->id);
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaDescending(): void
    {
        $modelB = TestUserFactory::new()->create(['name' => 'B']);
        $modelA = TestUserFactory::new()->create(['name' => 'A']);
        $modelC = TestUserFactory::new()->create(['name' => 'C']);

        $repository = app(TestUserRepository::class);
        $orderByFieldCriteria = new OrderByFieldCriteria('name', 'desc');
        $repository->pushCriteria($orderByFieldCriteria);

        $result = $repository->all();

        self::assertSame($modelC->id, $result->first()->id);
        self::assertSame($modelB->id, $result->get(1)->id);
        self::assertSame($modelA->id, $result->last()->id);
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaThrowExceptionWhenSortOrderIsWrong(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $repository = app(TestUserRepository::class);
        $orderByFieldCriteria = new OrderByFieldCriteria('name', 'wrong');
        $repository->pushCriteria($orderByFieldCriteria);
    }
}
