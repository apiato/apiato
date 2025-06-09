<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\OrderByNameCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(OrderByNameCriteria::class)]
final class OrderByNameCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        $modelB = TestUserFactory::new()->create(['name' => 'B']);
        $modelA = TestUserFactory::new()->create(['name' => 'A']);
        $modelC = TestUserFactory::new()->create(['name' => 'C']);

        $repository = app(TestUserRepository::class);
        $orderByNameCriteria = new OrderByNameCriteria();
        $repository->pushCriteria($orderByNameCriteria);

        $result = $repository->all();

        self::assertSame($modelA->id, $result->first()->id);
        self::assertSame($modelB->id, $result->get(1)->id);
        self::assertSame($modelC->id, $result->last()->id);
    }
}
