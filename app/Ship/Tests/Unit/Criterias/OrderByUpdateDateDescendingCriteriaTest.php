<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criterias;

use App\Ship\Criterias\OrderByUpdateDateDescendingCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(OrderByUpdateDateDescendingCriteria::class)]
final class OrderByUpdateDateDescendingCriteriaTest extends ShipTestCase
{
    public function testCriteria(): void
    {
        $modelB = TestUserFactory::new()->create(['updated_at' => now()]);
        $modelA = TestUserFactory::new()->create(['updated_at' => now()->subDay()]);
        $modelC = TestUserFactory::new()->create(['updated_at' => now()->addDay()]);

        $repository = app(TestUserRepository::class);
        $orderByUpdateDateDescendingCriteria = new OrderByUpdateDateDescendingCriteria();
        $repository->pushCriteria($orderByUpdateDateDescendingCriteria);

        $result = $repository->all();

        $this->assertSame($modelC->id, $result->first()->id);
        $this->assertSame($modelB->id, $result->get(1)->id);
        $this->assertSame($modelA->id, $result->last()->id);
    }
}
