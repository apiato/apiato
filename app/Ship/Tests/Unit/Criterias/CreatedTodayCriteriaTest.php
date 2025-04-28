<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criterias;

use App\Ship\Criterias\CreatedTodayCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(CreatedTodayCriteria::class)]
final class CreatedTodayCriteriaTest extends ShipTestCase
{
    public function testCriteria(): void
    {
        TestUserFactory::new()->count(5)->create(['created_at' => now()]);
        TestUserFactory::new()->count(2)->create(['created_at' => now()->subDay()]);
        TestUserFactory::new()->count(1)->create(['created_at' => now()->addDay()]);

        $repository = app(TestUserRepository::class);
        $createdTodayCriteria = new CreatedTodayCriteria();
        $repository->pushCriteria($createdTodayCriteria);

        $result = $repository->all();

        $this->assertCount(6, $result);
    }
}
