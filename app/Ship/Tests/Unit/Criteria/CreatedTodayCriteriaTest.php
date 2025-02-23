<?php

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\CreatedTodayCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(CreatedTodayCriteria::class)]
final class CreatedTodayCriteriaTest extends ShipTestCase
{
    public function testCriteria(): void
    {
        $todayModels = TestUserFactory::new()->count(5)->create(['created_at' => now()]);
        $yesterdayModels = TestUserFactory::new()->count(2)->create(['created_at' => now()->subDay()]);
        $tomorrowModels = TestUserFactory::new()->count(1)->create(['created_at' => now()->addDay()]);

        $repository = app(TestUserRepository::class);
        $criteria = new CreatedTodayCriteria();
        $repository->pushCriteria($criteria);

        $result = $repository->all();

        $this->assertCount(6, $result);
    }
}
