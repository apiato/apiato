<?php

namespace App\Ship\Tests\Unit\Criterias;

use App\Ship\Criterias\OrderByCreationDateDescendingCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversClass(OrderByCreationDateDescendingCriteria::class)]
final class OrderByCreationDateDescendingCriteriaTest extends ShipTestCase
{
    public function testCriteria(): void
    {
        $modelB = TestUserFactory::new()->create(['created_at' => now()]);
        $modelA = TestUserFactory::new()->create(['created_at' => now()->subDay()]);
        $modelC = TestUserFactory::new()->create(['created_at' => now()->addDay()]);

        $repository = app(TestUserRepository::class);
        $criteria = new OrderByCreationDateDescendingCriteria();
        $repository->pushCriteria($criteria);

        $result = $repository->all();

        $this->assertSame($modelC->id, $result->first()->id);
        $this->assertSame($modelB->id, $result->get(1)->id);
        $this->assertSame($modelA->id, $result->last()->id);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->createTestUsersTable();
    }
}
