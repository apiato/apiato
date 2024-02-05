<?php

namespace App\Ship\Tests\Unit\Criterias;

use App\Ship\Criterias\ThisBetweenDatesCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversClass(ThisBetweenDatesCriteria::class)]
final class ThisBetweenDatesCriteriaTest extends ShipTestCase
{
    public function testCriteria(): void
    {
        $todayModels = TestUserFactory::new()->count(1)->create(['created_at' => now()]);
        $twoDaysAgoModels = TestUserFactory::new()->count(2)->create(['created_at' => now()->subDays(2)]);
        $twoDaysLaterModels = TestUserFactory::new()->count(3)->create(['created_at' => now()->addDays(2)]);

        $repository = app(TestUserRepository::class);
        $criteria = new ThisBetweenDatesCriteria('created_at', now()->subDay(), now()->addDay());
        $repository->pushCriteria($criteria);

        $result = $repository->all();

        $this->assertCount(1, $result);
        $this->assertSame($todayModels->first()->id, $result->first()->id);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->createTestUsersTable();
    }
}
