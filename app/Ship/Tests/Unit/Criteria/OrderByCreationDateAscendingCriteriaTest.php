<?php

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\OrderByCreationDateAscendingCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(OrderByCreationDateAscendingCriteria::class)]
final class OrderByCreationDateAscendingCriteriaTest extends ShipTestCase
{
    public function testCriteria(): void
    {
        $modelB = TestUserFactory::new()->create(['created_at' => now()]);
        $modelA = TestUserFactory::new()->create(['created_at' => now()->subDay()]);
        $modelC = TestUserFactory::new()->create(['created_at' => now()->addDay()]);

        $repository = app(TestUserRepository::class);
        $criteria = new OrderByCreationDateAscendingCriteria();
        $repository->pushCriteria($criteria);

        $result = $repository->all();

        $this->assertSame($modelA->id, $result->first()->id);
        $this->assertSame($modelB->id, $result->get(1)->id);
        $this->assertSame($modelC->id, $result->last()->id);
    }
}
