<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criterias;

use App\Ship\Criterias\CreatedTodayCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(CreatedTodayCriteria::class)]
final class CreatedTodayCriteriaTest extends ShipTestCase
{
    public function testCriteria(): void
    {
        TestUserFactory::new()->count(5)->create(['created_at' => Carbon::today()->addDay()]);
        TestUserFactory::new()->count(2)->create(['created_at' => Carbon::today()->subDay()]);
        TestUserFactory::new()->count(1)->create(['created_at' => Carbon::today()->addDays(2)]);

        $repository = app(TestUserRepository::class);
        $createdTodayCriteria = new CreatedTodayCriteria();
        $repository->pushCriteria($createdTodayCriteria);

        $result = $repository->all();

        $this->assertCount(6, $result);
    }
}
