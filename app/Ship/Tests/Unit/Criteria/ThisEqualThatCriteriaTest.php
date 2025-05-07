<?php

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\ThisEqualThatCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ThisEqualThatCriteria::class)]
final class ThisEqualThatCriteriaTest extends ShipTestCase
{
    public function testCriteria(): void
    {
        $modelB = TestUserFactory::new()->create(['name' => 'B']);
        $modelA = TestUserFactory::new()->create(['name' => 'A']);
        $modelC = TestUserFactory::new()->create(['name' => 'C']);

        $repository = app(TestUserRepository::class);
        $criteria = new ThisEqualThatCriteria('name', 'A');
        $repository->pushCriteria($criteria);

        $result = $repository->all();

        $this->assertSame(1, $result->count());
        $this->assertSame($modelA->id, $result->first()->id);
    }
}
