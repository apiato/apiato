<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criterias;

use App\Ship\Criterias\ThisBetweenDatesCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ThisBetweenDatesCriteria::class)]
final class ThisBetweenDatesCriteriaTest extends ShipTestCase
{
    public function testCriteria(): void
    {
        $todayModels = TestUserFactory::new()->count(1)->create(['created_at' => now()]);
        TestUserFactory::new()->count(2)->create(['created_at' => now()->subDays(2)]);
        TestUserFactory::new()->count(3)->create(['created_at' => now()->addDays(2)]);

        $repository = app(TestUserRepository::class);
        $thisBetweenDatesCriteria = new ThisBetweenDatesCriteria('created_at', now()->subDay(), now()->addDay());
        $repository->pushCriteria($thisBetweenDatesCriteria);

        $result = $repository->all();

        $this->assertCount(1, $result);
        $this->assertSame($todayModels->first()->id, $result->first()->id);
    }
}
